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
            'message' => "Read the problem statement above.\nCompare slopes how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cross-multiply in 64-bit', 'next' => 's2'],
                ['label' => 'Divide into floating point', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. (1,1), (500000001,500000000), (1000000000,999999998) → 1 instead of 2: the slopes differ by about 4 · 10^−18.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Point order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Input order', 'next' => 'wrong_b'],
                ['label' => 'Sort by day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[5,3],[1,3],[2,3],[3,1],[4,1]] → 3 instead of 4.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Only one point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single point draws no line; [[1,1]] → 0.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
