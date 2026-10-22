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
            'message' => "Problem: A table lists users’ transactions, each with an amount spent and a date. Report each user whose third transaction (by date) spent strictly more than each of their first two, with that third transaction’s amount and date. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOrder each user’s rows by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Date', 'next' => 's2'],
                ['label' => 'Amount', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Then row 3 is the third smallest; the sample reports user 1 with 20 and user 2 with 30.\nStep back to when you ordered by amount.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Third must beat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the second', 'next' => 'wrong_b'],
                ['label' => 'Both the first and the second', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sample then also reports user 2, whose 20 is below the first 30.\nStep back to when you checked only the second.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → user 1 with 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
