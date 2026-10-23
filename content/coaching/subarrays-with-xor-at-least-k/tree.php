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
            'message' => "Problem: Given an array of positive integers and a non-negative integer k, count the contiguous subarrays whose XOR of all elements is at least k. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSeed the trie with prefix 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 1, 4], k = 3 → 2 instead of 4.\nStep back to when you skipped the seed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR > k', 'next' => 'wrong_b'],
                ['label' => 'XOR ≥ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3], k = 3 → 0 instead of 1.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · B). Checks → 4, 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
