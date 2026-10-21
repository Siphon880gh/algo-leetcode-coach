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
            'message' => "Read the problem statement above.\nFor each cell, scan all previous columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep two minima', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³).\nStep back to when you scanned every column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same column as the minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the minimum', 'next' => 'wrong_b'],
                ['label' => 'Use the second minimum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adjacent rows must use different columns.\nStep back to when you reused the column.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its minimum', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A 1 × 1 grid returns its value.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,2,3],[4,5,6],[7,8,9]] → 13. [[7]] → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
