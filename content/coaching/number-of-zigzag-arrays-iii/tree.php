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
            'message' => "Problem: You get integers n, l and r. Count the arrays of length n with every value in [l, r], no two neighbors equal, and no three consecutive values strictly increasing or strictly decreasing. Return the count modulo 10^9 + 7. Here the value range can be far larger than n. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nHow many sample points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n + 1', 'next' => 's2'],
                ['label' => 'n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): n = 4 with 10 values → 1,290 instead of 3,390.\nStep back to when you used n points.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check: n = 4 with 4 values → 194 instead of 62.\nStep back to when you dropped the rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Constructed checks → 62, 3,390.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
