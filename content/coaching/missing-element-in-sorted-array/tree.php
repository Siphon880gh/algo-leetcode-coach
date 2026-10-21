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
            'message' => "Problem: nums is sorted ascending with unique values. Return the k-th missing number, counting up from nums[0]. nums = [4,7,9,10], k = 1 → 5. Same nums, k = 3 → 8. nums = [1,2,4], k = 3 → 6. (Restated from memory; limits and examples may differ slightly.)\nHow many numbers are missing before index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − nums[0] − i', 'next' => 's2'],
                ['label' => 'nums[i] − i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting starts at nums[0].\nStep back to when you dropped nums[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k is larger than the count at the last index. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'wrong_b'],
                ['label' => 'nums[n − 1] + k − miss(n − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The missing numbers continue past the end.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "First i with miss(i) ≥ k found. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i − 1] + k − miss(i − 1)', 'next' => 'success'],
                ['label' => 'nums[i] + k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer lies between nums[i − 1] and nums[i].\nStep back to when you started from nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [4,7,9,10], k = 1 → 5. [4,7,9,10], k = 3 → 8. [1,2,4], k = 3 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
