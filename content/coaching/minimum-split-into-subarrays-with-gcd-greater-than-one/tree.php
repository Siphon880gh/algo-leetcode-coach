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
            'message' => "Problem: You are given an array of integers, each at least 2. Split it into contiguous subarrays so that the GCD of every subarray is greater than 1, and return the fewest subarrays needed. For instance, [12,6,3,14,8] → 2 and [4,12,6,14] → 1. (Restated from memory; limits and examples may differ slightly.)\nThe running GCD becomes 1 at x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'New piece; its GCD starts at x', 'next' => 's2'],
                ['label' => 'New piece; its GCD starts at 0, leaving x out', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x must belong to the new piece; [2,3,5] → 2 instead of 3.\nStep back to when you dropped x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start the piece count at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first piece exists before any cut; [4,12,6,14] → 0 instead of 1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log V). Constructed checks → 2, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
