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
            'message' => "Read the problem statement above.\nBuild the rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: row n has 2^(n − 1) symbols', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Row 30 has over 500 million symbols.\nStep back to when you built rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does position k come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Position k − 1 in the row above', 'next' => 'wrong_b'],
                ['label' => 'Position (k + 1) // 2 in the row above, flipped if k is even', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each symbol expands into two children.\nStep back to when you used k − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the closed form?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount(k − 1) % 2', 'next' => 'success'],
                ['label' => 'k % 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every 1 bit on the path is a flip, not just the last.\nStep back to when you used k % 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). n = 1, k = 1 → 0. n = 2, k = 2 → 1. n = 3, k = 3 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
