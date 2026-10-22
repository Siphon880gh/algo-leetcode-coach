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
            'message' => "Problem: Given an array of non-negative integers and an integer k, you may repeatedly replace two adjacent elements with their product when that product is at most k. Return the smallest length the array can reach. The exact conditions and limits are in the official statement. For instance, [2, 3, 3, 7, 3, 5] with k = 20 → 3 and [3, 9, 0] with k = 4 → 1. (Restated from memory; limits and examples may differ slightly.)\nAny zero?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1', 'next' => 's2'],
                ['label' => 'Ignore it and merge greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Greedy alone gives [3, 9, 0] with k = 4 → 2, but 1 is reachable.\nStep back to when you skipped zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merge while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'product < k', 'next' => 'wrong_b'],
                ['label' => 'product ≤ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A product equal to k is allowed; [4, 5] with k = 20 → 2 instead of 1.\nStep back to when you used a strict test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2, 3, 3, 7, 3, 5] with k = 20 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
