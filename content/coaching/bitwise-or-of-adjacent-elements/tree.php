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
            'message' => "Problem: Given an integer array nums, return the array whose i-th value is the bitwise OR of nums[i] and nums[i + 1]. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCombine with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR', 'next' => 's2'],
                ['label' => '+', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 3, 7, 15] → [4, 10, 22] instead of [3, 7, 15].\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n, wrapping the last to the first', 'next' => 'wrong_b'],
                ['label' => 'n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under the guide’s assumption [1, 3, 7, 15] → [3, 7, 15, 15] instead of [3, 7, 15].\nStep back to when you wrapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → [3, 7, 15], [12, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
