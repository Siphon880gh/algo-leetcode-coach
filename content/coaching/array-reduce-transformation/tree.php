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
            'message' => "Read the problem statement above.\nStarting value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'init', 'next' => 's2'],
                ['label' => 'nums[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. init is the first accumulator; Example 2 → 30 instead of 130.\nStep back to when you started from nums[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Argument order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'fn(nums[i], val)', 'next' => 'wrong_b'],
                ['label' => 'fn(val, nums[i])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. fn treats its first argument as the accumulator; Example 2 → about 1.0 · 10^32 instead of 130.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 130, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
