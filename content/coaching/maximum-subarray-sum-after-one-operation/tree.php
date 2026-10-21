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
            'message' => "Problem: Given an integer array nums, you must replace exactly one element with its square. Return the maximum possible sum of a non-empty subarray afterwards. For instance, [2,-1,-4,-3] → 17 (square −4 in [2,-1,-4]) and [3,-2,1] → 9 (just the squared 3). (Restated from memory; limits and examples may differ slightly.)\nAnswer from which state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sq only', 'next' => 's2'],
                ['label' => 'max(plain, sq)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Squaring exactly one element is mandatory.\nStep back to when you allowed plain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'plain before sq', 'next' => 'wrong_b'],
                ['label' => 'sq before plain', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. sq must extend the previous plain value, not one that already includes x.\nStep back to when you updated plain first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start a fresh squared run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, x² alone is allowed', 'next' => 'success'],
                ['label' => 'No, always extend', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The best subarray may start at the squared element.\nStep back to when you forced extension.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1). Constructed check → 17, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
