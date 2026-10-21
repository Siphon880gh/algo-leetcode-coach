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
            'message' => "Problem: Given an array nums of positive integers (values are small, at most 100), count the triplets of distinct indices (i, j, k), in any order, such that nums[i] + nums[j] + nums[k] is divisible by exactly one of nums[i], nums[j] and nums[k]. For instance, [4,6,7,3,2] → 12; [1,2,2] → 6; [1,1,1] → 0. (Restated from memory; limits and examples may differ slightly.)\nLoop over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Value triples (values ≤ 100)', 'next' => 's2'],
                ['label' => 'Index triples', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n can be large, so n³ index triples are far too many.\nStep back to when you looped over indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight of three different values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ca · cb · cc', 'next' => 'wrong_b'],
                ['label' => '6 · ca · cb · cc', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Index triples are ordered; [4,6,7,3,2] → 2 instead of 12.\nStep back to when you dropped the 6.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly one of the three divides the sum', 'next' => 'success'],
                ['label' => 'At least one divides it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,1,1] → 6 instead of 0; every 1 divides 3.\nStep back to when you used at least one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 100³). Constructed cases → 12, 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
