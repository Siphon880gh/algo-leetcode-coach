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
            'message' => "Read the problem statement above.\nPair stones with empty cells by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trying every assignment', 'next' => 's2'],
                ['label' => 'Nearest stone for each empty cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Greedy can strand far stones; in code [[0, 2, 0], [2, 0, 3], [0, 1, 1]] → 6 instead of 4.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One stone’s cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 move', 'next' => 'wrong_b'],
                ['label' => 'Manhattan distance', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each step is a move; example 1 has one empty cell → 1 instead of 3.\nStep back to when you charged 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(8! · 8). Examples → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
