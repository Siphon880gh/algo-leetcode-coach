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
            'message' => "Problem: Given an integer array nums and an integer k, one operation adds or subtracts 1 from any element. Return the fewest operations so that some window of k consecutive elements holds a single repeated value. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTarget value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The window median', 'next' => 's2'],
                ['label' => 'The rounded-down mean', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 10, 2, 9, 3], k = 3 → 8 instead of 7.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort it again', 'next' => 'wrong_b'],
                ['label' => 'Update two halves with sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n · k log k), which the guide assumes is too slow.\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log k). The guide’s checks → 2, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
