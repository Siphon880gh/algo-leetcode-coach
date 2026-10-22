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
            'message' => "Read the problem statement above.\nFrom a start cell the fisher catches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All fish in its connected component', 'next' => 's2'],
                ['label' => 'Only the start cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moving between water cells is free; Example 1 → 4 instead of 7.\nStep back to when you stayed put.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cells are adjacent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All eight around', 'next' => 'wrong_b'],
                ['label' => 'The four side neighbours', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Diagonals do not connect; Example 1 → 20 instead of 7.\nStep back to when you added diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 7, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
