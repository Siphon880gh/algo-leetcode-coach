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
            'message' => "Problem: Given an array of distinct integers and k, return the largest subarray of length k, where subarrays compare by their first differing element. For instance, [1,4,5,2,3] with k = 3 → [5,2,3]. (Restated from memory; limits and examples may differ slightly.)\nCompare whole windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the first element decides', 'next' => 's2'],
                ['label' => 'Yes, element by element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Distinct values never tie at the first position.\nStep back to when you compared everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidate starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … n − 1', 'next' => 'wrong_b'],
                ['label' => '0 … n − k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later starts cannot fit k elements.\nStep back to when you used n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n · k)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One max scan suffices.\nStep back to when you compared windows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check: k = 3 → [5,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
