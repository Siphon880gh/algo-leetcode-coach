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
            'message' => "Problem: The gcd-sum of a subarray is the sum of its elements times the gcd of its elements. Given an array of positive integers and an integer k, return the largest gcd-sum among subarrays with at least k elements. Limits are in the official statement. For instance, [2, 1, 4, 4, 4, 2] with k = 2 → 48, and with k = 4 → 28. (Restated from memory; limits and examples may differ slightly.)\nFor one gcd at right end r, which start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 's2'],
                ['label' => 'The rightmost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With positive values the longer subarray has the larger sum; the k = 2 example → 15 instead of 48.\nStep back to when you kept the rightmost.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Length rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'r − start + 1 ≥ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The k = 4 example → 48 instead of 28.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). The examples → 48, 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
