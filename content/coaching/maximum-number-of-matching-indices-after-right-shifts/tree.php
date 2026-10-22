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
            'message' => "Problem: Given two arrays of the same length, you may rotate the first one to the right any number of times. Return the largest number of indices where the two arrays hold equal values. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equal values at the same index', 'next' => 's2'],
                ['label' => 'Common values anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 3] and [1, 3, 2] → 3 instead of 1.\nStep back to when you ignored positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shifts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only no shift', 'next' => 'wrong_b'],
                ['label' => 'All n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 1, 2, 3, 1, 2] and [1, 2, 3, 1, 2, 3] → 0 instead of 6.\nStep back to when you skipped the shifts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). The guide’s checks → 6, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
