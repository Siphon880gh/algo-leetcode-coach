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
            'message' => "Problem: Given an array of positive integers and an integer k, return the k-th smallest sum among all non-empty subarrays (counting each subarray separately). For instance, [2,1,3] with k = 4 → 3, and [3,3,5,5] with k = 7 → 10. (Restated from memory; limits and examples may differ slightly.)\nList all sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, up to n²/2 of them', 'next' => 's2'],
                ['label' => 'Yes, sort them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is too many for large n.\nStep back to when you listed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does a window work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It always works', 'next' => 'wrong_b'],
                ['label' => 'All values are positive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With negatives, shrinking would not reduce the sum reliably.\nStep back to when you assumed it always works.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest x with count ≥ k', 'next' => 'success'],
                ['label' => 'Largest x with count ≤ k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties mean many subarrays can share the k-th value.\nStep back to when you searched from above.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(sum)). Constructed check → 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
