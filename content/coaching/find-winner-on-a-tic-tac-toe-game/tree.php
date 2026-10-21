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
            'message' => "Read the problem statement above.\nWho plays move 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A', 'next' => 's2'],
                ['label' => 'B', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A always starts.\nStep back to when you started with B.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lines to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows and columns only', 'next' => 'wrong_b'],
                ['label' => '3 rows, 3 columns, 2 diagonals', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Diagonals win too.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No winner, fewer than 9 moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"Pending"', 'next' => 'success'],
                ['label' => '"Draw"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The board is not full yet.\nStep back to when you returned Draw.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(moves). [[0,0],[2,0],[1,1],[2,1],[2,2]] → \"A\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
