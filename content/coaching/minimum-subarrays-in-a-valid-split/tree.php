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
            'message' => "Problem: Split nums into contiguous subarrays so that, in every subarray, the GCD of its first and last elements is greater than 1. Return the fewest subarrays, or −1 if no valid split exists. For instance, [2,6,3,4,3] → 2, [3,5] → 2, and [1,2,1] → −1. (Restated from memory; limits and examples may differ slightly.)\nA piece is valid when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd(first, last) > 1', 'next' => 's2'],
                ['label' => 'The GCD of the whole piece is > 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Middle values do not matter; [2,3,2] → 3 instead of 1.\nStep back to when you used the whole piece.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is a single number always a valid piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'Only if it is above 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. gcd(1, 1) = 1; [1,2,1] → 3 instead of −1.\nStep back to when you accepted every single number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log V). Constructed checks → 2, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
