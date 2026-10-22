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
            'message' => "Problem: A table lists pizza toppings, each with a cost. Report every combination of three different toppings with its total cost, rounded and formatted as the statement asks. Table, column and output names, how a combination is written, and the ordering are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't1 < t2 and t2 < t3', 'next' => 's2'],
                ['label' => 'Not equal (≠)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each set appears in every order; the check → 24 rows instead of 4.\nStep back to when you used ≠.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is t1 < t2 and t1 < t3 enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, chain t1 < t2 < t3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows t2 = t3 and both orders of t2, t3; the check → 14 rows instead of 4.\nStep back to when you anchored on t1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). The check → 4 combinations, top 1.75.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
