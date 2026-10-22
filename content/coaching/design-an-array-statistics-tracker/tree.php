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
            'message' => "Problem: Design a tracker over a queue of numbers: add a number, remove the earliest added number, and report the floored mean, the median, and the mode (the smallest value on ties). Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nMedian of an even count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger middle value', 'next' => 's2'],
                ['label' => 'The lower middle value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After adding 4, 1, 7, 3 → 3 instead of 4.\nStep back to when you took the lower one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mode on ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest value', 'next' => 'wrong_b'],
                ['label' => 'The smallest value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After adding 4, 1, 7, 3 → 7 instead of 1.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per operation. The guide’s check → mean 3, median 4, mode 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
