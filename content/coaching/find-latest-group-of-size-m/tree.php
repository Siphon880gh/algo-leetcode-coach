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
            'message' => "Read the problem statement above.\nWhere to store run lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At run endpoints only', 'next' => 's2'],
                ['label' => 'At every cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Updating every cell is O(n) per step.\nStep back to when you updated all cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only add', 'next' => 'wrong_b'],
                ['label' => 'Remove l and r runs if == m, add the merged one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Merged runs no longer exist.\nStep back to when you only added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "m == n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer n', 'next' => 'success'],
                ['label' => 'Answer −1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The final step makes one run of n.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,5,1,2,4], 1 → 4. [3,1,5,4,2], 2 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
