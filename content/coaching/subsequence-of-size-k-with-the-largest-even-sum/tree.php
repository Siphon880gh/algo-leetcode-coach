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
            'message' => "Problem: Given an integer array nums of non-negative values and an integer k, return the largest even sum of any subsequence of nums of length k, or −1 if no such sum exists. For instance, [4,1,5,3,1] with k = 3 → 12; [4,6,2] with k = 3 → 12; [1,3,5] with k = 1 → −1. (Restated from memory; limits and examples may differ slightly.)\nStarting point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k largest values', 'next' => 's2'],
                ['label' => 'The k smallest values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You want the largest sum.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Their sum is odd. Fix it how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap the smallest chosen value for the largest unchosen', 'next' => 'wrong_b'],
                ['label' => 'Swap an odd inside for an even outside, or an even inside for an odd outside', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [5,4,2,2] with k = 2: swapping 4 for 2 gives 7, still odd; the answer is 6.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No swap of the right parity exists?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the odd sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only even sums count; [1,3,5] with k = 1 → −1.\nStep back to when you returned the odd sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 12, 12, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
