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
            'message' => "Read the problem statement above.\nTry every pair of corners?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix two rows and reduce to one dimension', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(m² n²).\nStep back to when you tried all corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you count subarrays with sum target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sliding window', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums with a hash map of counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative values break sliding windows.\nStep back to when you slid a window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does the map start with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '{0: 1}', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subarrays starting at column 0 would be missed.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m² · n). [[0,1,0],[1,1,1],[0,1,0]], 0 → 4. [[1,−1],[−1,1]], 0 → 5. [[904]], 0 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
