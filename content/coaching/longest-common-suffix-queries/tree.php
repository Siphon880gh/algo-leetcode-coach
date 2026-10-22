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
            'message' => "Read the problem statement above.\nTies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shortest length, then earliest', 'next' => 's2'],
                ['label' => 'Earliest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [0, 0, 0] instead of [1, 1, 1].\nStep back to when you took the earliest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No common suffix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'wrong_b'],
                ['label' => 'Use the root’s best index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every word shares the empty suffix: example 1 → [1, 1, −1].\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → [1, 1, 1], [2, 0, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
