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
            'message' => "Problem: Given an array nums of length n, the sum score at index i is the larger of the sum of the first i + 1 elements and the sum of the last n − i elements (both include nums[i]). Return the maximum sum score over all indices. Values may be negative. For instance, [4,3,-2,5] → 10; [-3,-5] → −3. (Restated from memory; limits and examples may differ slightly.)\nSuffix sum at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't − p + nums[i]', 'next' => 's2'],
                ['label' => 't − p', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That suffix starts after i and can be empty; [-3,-5] → 0 instead of −3.\nStep back to when you dropped nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'Minus infinity', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every score can be negative; [-3,-5] → 0 instead of −3.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compute sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Running prefix and the total', 'next' => 'success'],
                ['label' => 'Re-add both parts at every index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n²) on long arrays.\nStep back to when you re-added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 10, −3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
