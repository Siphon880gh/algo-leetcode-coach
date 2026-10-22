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
            'message' => "Read the problem statement above.\nNew start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(parent’s start, last + 1)', 'next' => 's2'],
                ['label' => 'last + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. edges [[0, 1, 2], [1, 2, 5], [2, 3, 3], [0, 4, 1]], nums [0, 3, 0, 2, 3] → [10, 4] instead of [8, 3].\nStep back to when you dropped the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'More nodes', 'next' => 'wrong_b'],
                ['label' => 'Fewer nodes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [6, 3] instead of [6, 2].\nStep back to when you kept more nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [6, 2], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
