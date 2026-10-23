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
            'message' => "Problem: You get an array nums of positive integers. One operation picks one element and either multiplies it by an integer k ≥ 2, or divides it by an integer k with 2 ≤ k < the element, when k divides it exactly. Return the fewest operations that make all elements equal. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTarget?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each distinct value in nums, or n for a common multiple', 'next' => 's2'],
                ['label' => 'Always a common multiple', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [4, 8, 12] → 3 instead of 2.\nStep back to when you always multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the smallest', 'next' => 'wrong_b'],
                ['label' => 'Every distinct value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [3, 5, 7] → 4 instead of 3.\nStep back to when you only tried the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(D · (π(√V) + d(V))). Constructed checks → 2, 3, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
