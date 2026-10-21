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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count chains of distinct values, then placements', 'next' => 's2'],
                ['label' => 'DP over every position and last value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n and maxValue up to 10^4 with every multiple at each step is around 10^9 operations.\nStep back to when you ran a DP over positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Chain steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allow repeating the same value', 'next' => 'wrong_b'],
                ['label' => 'Strictly increasing multiples', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeats are already covered by placements; Example 1 → 15 instead of 10.\nStep back to when you allowed repeats in the chain.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Placements for k distinct values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(n − 1, k − 1)', 'next' => 'success'],
                ['label' => 'C(n, k)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You choose which k − 1 of the n − 1 gaps change value; Example 1 → 15 instead of 10.\nStep back to when you used C(n, k).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(maxValue · log maxValue · 14). Examples → 10, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
