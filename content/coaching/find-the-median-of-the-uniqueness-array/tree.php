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
            'message' => "Read the problem statement above.\nBuild the uniqueness array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, count subarrays with at most d distinct', 'next' => 's2'],
                ['label' => 'Yes, then sort', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It has about 5 · 10^9 entries at n = 10^5.\nStep back to when you built it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Threshold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊T / 2⌋ + 1', 'next' => 'wrong_b'],
                ['label' => '⌈T / 2⌉', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the larger middle: example 1 → 2 instead of 1.\nStep back to when you used ⌊T / 2⌋ + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
