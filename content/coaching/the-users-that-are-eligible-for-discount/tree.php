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
            'message' => "Problem: A table Purchases records user_id, time_stamp and amount. Given a start date, an end date and a minimum amount, return the ids of users who made at least one purchase within the date range the statement defines with an amount of at least the minimum, in ascending order. For instance, with a mid-March range and minimum 1000, users with purchases of 2000 and 4416 in range qualify; a user with only 300 in range does not, nor one whose big purchase falls in April. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOne user with two qualifying purchases?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'List them once (DISTINCT)', 'next' => 's2'],
                ['label' => 'One row per purchase', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. User 1 in the constructed example would appear twice.\nStep back to when you dropped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Amount condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'amount > minAmount', 'next' => 'wrong_b'],
                ['label' => 'amount ≥ minAmount', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A purchase of exactly the minimum qualifies.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY user_id', 'next' => 'success'],
                ['label' => 'Whatever order the rows come in', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for ascending user ids.\nStep back to when you left it unordered.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
