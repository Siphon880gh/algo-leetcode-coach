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
            'message' => "Read the problem statement above.\nValues can be negative. Use a sliding window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix sums with a hash map', 'next' => 's2'],
                ['label' => 'Yes: grow and shrink a window', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With negatives, adding an element can lower the sum, so there is no safe rule for when to shrink.\nStep back to when you used a window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At prefix sum s, which earlier prefixes end a good subarray here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those equal to k − s', 'next' => 'wrong_b'],
                ['label' => 'Those equal to s − k: add how many there are', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. sum(j + 1 .. i) = s_i − s_j = k means s_j = s_i − k.\nStep back to when you looked up k − s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does the map start with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '{0: 1}, so subarrays that start at index 0 count', 'next' => 'success'],
                ['label' => 'An empty map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For [3], k = 3, the prefix 3 needs an earlier prefix 0, which only the seed provides.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Running prefix sum, add count[s − k], seed {0: 1}: O(n) time and space. [1,1,1], k = 2 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
