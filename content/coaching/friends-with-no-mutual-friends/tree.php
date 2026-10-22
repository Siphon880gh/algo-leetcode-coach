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
            'message' => "Problem: A table lists pairs of users who are friends, each pair once. Report the friend pairs that have no friend in common. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFind neighbours with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pairs in both directions', 'next' => 's2'],
                ['label' => 'Pairs as stored', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check also returns (1, 5), (2, 4), (2, 5), (3, 4).\nStep back to when you used one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rows to report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair of the symmetric list', 'next' => 'wrong_b'],
                ['label' => 'Stored pairs', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each answer appears twice: (6, 7) and (7, 6).\nStep back to when you reported the symmetric list.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The check → (6, 7), (8, 9).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
