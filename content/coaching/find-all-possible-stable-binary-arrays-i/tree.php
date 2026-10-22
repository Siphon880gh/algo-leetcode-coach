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
            'message' => "Read the problem statement above.\nLimit on runs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most limit', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 20 instead of 14.\nStep back to when you dropped the limit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Longest allowed run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'limit + 1', 'next' => 'wrong_b'],
                ['label' => 'limit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 3 instead of 1.\nStep back to when you allowed limit + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(zero · one · limit). Examples → 2, 1, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
