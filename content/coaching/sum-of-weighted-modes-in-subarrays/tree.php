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
            'message' => "Problem: Given an integer array nums and an integer k, look at every subarray of length k. Its mode is the value with the highest frequency, and this assumes ties go to the smaller value. Add mode × frequency for every such subarray and return the total. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller value', 'next' => 's2'],
                ['label' => 'Larger value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2], k = 2 → 2 instead of 1.\nStep back to when you took the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The heap top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trust it', 'next' => 'wrong_b'],
                ['label' => 'Pop until its count matches', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 3, 2, 2], k = 3 → 10 instead of 8.\nStep back to when you trusted a stale top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Checks → 1, 5, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
