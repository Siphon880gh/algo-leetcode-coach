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
            'message' => "Problem: An inversion pair with threshold x is a pair i < j with nums[i] > nums[j] and nums[i] − nums[j] ≤ x. Return the smallest x giving at least k such pairs, or −1 if none does. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPair counts for threshold x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − nums[j] ≤ x', 'next' => 's2'],
                ['label' => 'nums[i] − nums[j] < x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 1, 4, 2], k = 2 → 3 instead of 2.\nStep back to when you used a strict bound.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them too', 'next' => 'wrong_b'],
                ['label' => 'Not an inversion', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 3, 1], k = 1 → 0 instead of 2.\nStep back to when you counted equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · log(max − min)). Checks → 2, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
