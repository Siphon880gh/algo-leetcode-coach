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
            'message' => "Read the problem statement above.\nnum = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0: the empty set', 'next' => 's2'],
                ['label' => 'Return −1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The empty set sums to 0; Example 3 → −1 instead of 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try c in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10 down to 1', 'next' => 'wrong_b'],
                ['label' => '1 up to 10', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. num = 20, k = 5 → 4 instead of 2 (5 + 15).\nStep back to when you counted down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Test for c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c · k ≤ num and num − c · k divisible by 10', 'next' => 'success'],
                ['label' => 'Only num − c · k divisible by 10', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. num = 4, k = 9 → 6 instead of −1: six numbers ending in 9 sum to at least 54.\nStep back to when you dropped c · k ≤ num.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, −1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
