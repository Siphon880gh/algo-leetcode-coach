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
            'message' => "Problem: You get an integer array nums and an integer k. One operation adds or subtracts 1 from an element. Make the array modulo alternating: every even index has remainder x mod k, every odd index has remainder y, with x ≠ y. Return the fewest operations. It is the same task as Minimum Operations to Make Array Modulo Alternating I with much larger limits on n and k. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nx = y allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Part I example 2 → 0 instead of 1.\nStep back to when you allowed equal residues.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best residues clash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only move the odd side', 'next' => 'wrong_b'],
                ['label' => 'Try second best on either side', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [7, 29, 28, 7, 11, 1], k = 2 → 4 instead of 2.\nStep back to when you fixed the even side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Constructed checks → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
