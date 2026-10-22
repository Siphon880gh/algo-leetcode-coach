<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: A table lists purchases with a user, a date within one month named in the statement, and an amount. For each Friday of that month that has at least one purchase, report its week of the month, the date and the total amount spent. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Date', 'next' => 's2'],
                ['label' => 'User and date', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A Friday’s total splits by user; the sample’s 1st gives 100 and 50 instead of 150.\nStep back to when you grouped by user.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Week number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'day / 7', 'next' => 'wrong_b'],
                ['label' => '(day + 6) / 7', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The 1st would be week 0 and the 29th week 4.\nStep back to when you used day / 7.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → weeks 1, 3, 5 with 150, 30, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
