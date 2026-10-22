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
            'message' => "Problem: You have an unlimited supply of coins of a few fixed values and a limited number of coins of one more value. Count the ways to make the sum n, where the same coins in a different order count once. Return the count modulo the value the statement gives. The coin values, the limit and n’s range are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nLimited coin?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add dp[n − t · v] for t ≤ c', 'next' => 's2'],
                ['label' => 'Treat it as unlimited', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check n = 6 → 7 instead of 6.\nStep back to when you dropped the limit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sums outside', 'next' => 'wrong_b'],
                ['label' => 'Coins outside, sums inside', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts orders: n = 4 → 7 instead of 4.\nStep back to when you put sums outside.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · coins). The guide’s checks → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
