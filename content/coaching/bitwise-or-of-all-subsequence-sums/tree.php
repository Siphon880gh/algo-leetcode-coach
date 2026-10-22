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
            'message' => "Problem: Given an integer array nums of non-negative values, return the bitwise OR of the sums of all its subsequences. For instance, [2,1,0,3] → 7 and [0,0,0] → 0. (Restated from memory; limits and examples may differ slightly.)\nOR together?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every element and every prefix sum', 'next' => 's2'],
                ['label' => 'Only the elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Carries create new bits; [2,1,0,3] → 3 instead of 7.\nStep back to when you used only the elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Could the prefix sums alone do it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, drop the elements', 'next' => 'wrong_b'],
                ['label' => 'No, keep the elements too', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2,6] → 10 instead of 14, missing the 6 on its own.\nStep back to when you dropped the elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 7, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
