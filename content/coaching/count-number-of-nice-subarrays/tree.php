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
            'message' => "Read the problem statement above.\nPlain sliding window for exactly k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix counts, or atMost(k) − atMost(k − 1)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Even numbers at the edges create several valid windows.\nStep back to when you used one window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty', 'next' => 'wrong_b'],
                ['label' => '{0: 1}', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subarrays starting at index 0 need prefix 0.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Look up which prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'odd − k', 'next' => 'success'],
                ['label' => 'odd + k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Earlier prefixes are smaller.\nStep back to when you added k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,2,1,1], 3 → 2. [2,4,6], 1 → 0. [2,2,2,1,2,2,1,2,2,2], 2 → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
