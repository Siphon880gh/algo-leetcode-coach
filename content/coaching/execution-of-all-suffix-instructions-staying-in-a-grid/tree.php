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
            'message' => "Read the problem statement above.\nWhere does the walk for suffix i start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At startPos', 'next' => 's2'],
                ['label' => 'Where the previous suffix ended', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each suffix is a separate run from startPos.\nStep back to when you carried the position over.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A move would leave the grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and continue', 'next' => 'wrong_b'],
                ['label' => 'Stop there', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The robot stops at the first move that would leave the grid.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Moves actually made', 'next' => 'success'],
                ['label' => 'Moves including the one that fails', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 starts with 1, not 2.\nStep back to when you counted the failing move.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m²). Examples → [1,5,4,3,1,0], [4,1,0,0], [0,0,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
