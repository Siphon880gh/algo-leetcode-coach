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
            'message' => "Read the problem statement above.\nSearch over sequences of swaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check feasibility, then count with a formula', 'next' => 's2'],
                ['label' => 'Yes, BFS on boards', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The number of boards is astronomical.\nStep back to when you searched boards.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What must hold for every i, j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every row has the same number of 1s', 'next' => 'wrong_b'],
                ['label' => 'b[0][0] ^ b[i][0] ^ b[0][j] ^ b[i][j] == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is necessary but not enough; rows must each equal the first row or its complement.\nStep back to when you only counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n is even with m mismatches against 0101…. Swaps needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(m, n − m) / 2', 'next' => 'success'],
                ['label' => 'm', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each swap fixes two positions, and either pattern is allowed when n is even.\nStep back to when you used m.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[0,1,1,0],[0,1,1,0],[1,0,0,1],[1,0,0,1]] → 2. [[0,1],[1,0]] → 0. [[1,0],[1,0]] → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
