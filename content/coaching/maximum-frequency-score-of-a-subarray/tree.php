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
            'message' => "Problem: Given an integer array nums and an integer k, every subarray of length k has a frequency score built from its distinct values and how often each occurs: roughly, each distinct value raised to the power of its count, summed and reduced modulo a large prime; the exact definition and modulus are in the official statement. Return the largest score over all such subarrays. For instance, [1,1,1,2,1,2] with k = 3 → 5, from [2,1,2]: 2² + 1. (Restated from memory; limits and examples may differ slightly.)\nA value leaves the window completely?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove its term', 'next' => 's2'],
                ['label' => 'Keep a term for count 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A missing value adds nothing; under the rule above, [2,2,3,3] with k = 2 → 10 instead of 9.\nStep back to when you kept the term.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One copy of y leaves, others stay?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract y from its term', 'next' => 'wrong_b'],
                ['label' => 'Divide its term by y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The term is a power, not a sum; under the rule above, [2,2,2,3] with k = 3 → 9 instead of 8.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log M) with modular inverses. Constructed checks → 5, 9, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
