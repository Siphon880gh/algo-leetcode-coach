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
            'message' => "Problem: Given two equal-length integer arrays, the product sum is the sum of a[i] · b[i]. You may rearrange the first array (as the statement allows); return the minimum possible product sum. For instance, [5,3,4,2] and [4,2,2,5] → 40, and [2,1,4,5,7] and [3,2,4,8,6] → 65. (Restated from memory; limits and examples may differ slightly.)\nSort orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Opposite', 'next' => 's2'],
                ['label' => 'Both ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That maximises the product sum.\nStep back to when you sorted both ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try all permutations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, the pairing is fixed by sorting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n! is far too many.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Values bounded and small?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counting sort is an option', 'next' => 'success'],
                ['label' => 'Sorting is required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counting sort gives the same order in linear time.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check → 40, 65.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
