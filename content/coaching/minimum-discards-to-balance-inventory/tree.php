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
            'message' => "Read the problem statement above.\nWhat does the window count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Kept arrivals only', 'next' => 's2'],
                ['label' => 'Every arrival, kept or not', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 3, 3, 2], w = 2, m = 1 → 2 instead of 1.\nStep back to when you counted discards.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last w + 1 days', 'next' => 'wrong_b'],
                ['label' => 'The last w days, i − w + 1 … i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 0.\nStep back to when you widened the window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
