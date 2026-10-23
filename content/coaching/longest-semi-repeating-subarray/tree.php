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
            'message' => "Problem: Given an integer array and an integer k, call a subarray semi-repeating if at most k distinct values appear more than once in it. Return the length of the longest semi-repeating subarray. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct values that appear twice or more', 'next' => 's2'],
                ['label' => 'Extra copies', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 1, 1], k = 1 → 2 instead of 3.\nStep back to when you counted copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Repeated values ≥ k', 'next' => 'wrong_b'],
                ['label' => 'Repeated values > k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 1], k = 1 → 1 instead of 3.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → 4, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
