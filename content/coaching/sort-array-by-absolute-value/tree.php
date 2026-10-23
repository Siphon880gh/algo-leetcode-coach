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
            'message' => "Problem: Given an integer array, rearrange it so the absolute values are in non-decreasing order and return it. This assumes any order of elements with the same absolute value is accepted. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|x|', 'next' => 's2'],
                ['label' => 'x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, −3, 1] → [−3, 1, 2] instead of [1, 2, −3].\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal |x| like −5 and 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep one', 'next' => 'wrong_b'],
                ['label' => 'Keep both, in any order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [−5, 5, 0] → [0, 5] instead of [0, −5, 5].\nStep back to when you dropped one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Checks → [1, 2, −3], [0, −5, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
