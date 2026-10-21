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
            'message' => "Problem: nums has up to 10⁴ values from −10⁴ to 10⁴, and 1 ≤ k ≤ n. Return the largest average of any contiguous subarray of length at least k (within 10⁻⁵). [1,12,-5,-6,50,3], k = 4 → 12.75. (Restated from memory; limits and examples may differ slightly.)\nTry every start and every length ≥ k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search on the average', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) subarrays.\nStep back to when you tried every subarray.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you check a guess m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Is there a window of exactly k with average ≥ m?', 'next' => 'wrong_b'],
                ['label' => 'Subtract m from every value; is there a subarray of length ≥ k with sum ≥ 0?', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A longer subarray can have a higher average, so length k alone is not enough.\nStep back to when you fixed the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you find such a subarray quickly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums, keeping the minimum prefix at least k positions back', 'next' => 'success'],
                ['label' => 'The minimum prefix over all earlier positions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A prefix closer than k positions makes the subarray too short.\nStep back to when you used every earlier prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Binary search on the average with an O(n) prefix check: O(n log(range / 10⁻⁵)). → 12.75.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
