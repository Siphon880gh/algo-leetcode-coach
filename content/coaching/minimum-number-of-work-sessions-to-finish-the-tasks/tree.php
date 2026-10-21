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
            'message' => "Read the problem statement above.\nn ≤ 14 suggests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bitmask DP over subsets of tasks', 'next' => 's2'],
                ['label' => 'Sort descending and pack greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy packing can waste space: [5,4,2,3,4,2] with sessionTime 10 packs into 3 sessions, but 5+3+2 and 4+4+2 use 2.\nStep back to when you packed greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[mask] transition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[mask without its lowest task] + 1', 'next' => 'wrong_b'],
                ['label' => 'Remove one fitting submask: dp[mask ^ s] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That gives every task its own session.\nStep back to when you removed one task per session.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost of enumerating submasks of every mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(3^n)', 'next' => 'success'],
                ['label' => 'O(4^n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Walking s = (s − 1) & mask visits 3^n pairs in total, about 4.8 · 10^6.\nStep back to when you counted all mask pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 2, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
