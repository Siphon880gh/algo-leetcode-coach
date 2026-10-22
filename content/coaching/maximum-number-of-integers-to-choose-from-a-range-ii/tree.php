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
            'message' => "Problem: The same task as part I: choose as many distinct integers from 1 to n as possible, skipping a banned list, with their sum at most maxSum. Here n and maxSum are far too large to walk the numbers one by one; the exact limits are in the official statement. For instance, banned [1,4,6], n = 6, maxSum = 10 → 3 (2 + 3 + 5), and with maxSum = 4 → 1. (Restated from memory; limits and examples may differ slightly.)\nThe last gap ends at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 's2'],
                ['label' => 'The largest banned value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Numbers after the last banned one still count; banned = [1], n = 5, maxSum = 100 → 0 instead of 4.\nStep back to when you stopped at the last banned value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum of t numbers starting at a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't · (a + t) / 2', 'next' => 'wrong_b'],
                ['label' => 't · (2a + t − 1) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That undercounts the series; banned = [4], n = 8, maxSum = 10 → 4 instead of 3.\nStep back to when you used the wrong formula.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(b log b + b log n). Constructed checks → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
