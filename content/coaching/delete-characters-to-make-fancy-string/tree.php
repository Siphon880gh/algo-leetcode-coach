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
            'message' => "Read the problem statement above.\nCompare with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last two kept characters', 'next' => 's2'],
                ['label' => 'The last two original characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Deleted characters no longer count.\nStep back to when you used the original string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run of length 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep 1', 'next' => 'wrong_b'],
                ['label' => 'Keep 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two equal neighbours are allowed.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A list, joined once', 'next' => 'success'],
                ['label' => 'Repeated string concatenation', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That can be quadratic.\nStep back to when you concatenated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"leetcode\", \"aabaa\", \"aab\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
