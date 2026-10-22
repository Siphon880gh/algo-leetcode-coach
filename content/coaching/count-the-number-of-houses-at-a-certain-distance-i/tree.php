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
            'message' => "Read the problem statement above.\nGraph?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Line plus the x – y street', 'next' => 's2'],
                ['label' => 'The line only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [8, 6, 4, 2, 0] instead of [10, 8, 2, 0, 0].\nStep back to when you dropped the street.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each pair counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once', 'next' => 'wrong_b'],
                ['label' => 'Twice (ordered)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [3, 0, 0] instead of [6, 0, 0].\nStep back to when you counted unordered pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [6, 0, 0], [10, 8, 2, 0, 0], [6, 4, 2, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
