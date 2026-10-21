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
            'message' => "Read the problem statement above.\nEqual neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compress runs first', 'next' => 's2'],
                ['label' => 'Judge each index separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3, counting the valley 1, 1 twice.\nStep back to when you counted each index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index 0 or n − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts when its one neighbour differs', 'next' => 'wrong_b'],
                ['label' => 'Never counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A hill or valley needs a different neighbour on both sides.\nStep back to when you counted an end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hills and valleys together', 'next' => 'success'],
                ['label' => 'Hills only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you dropped valleys.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
