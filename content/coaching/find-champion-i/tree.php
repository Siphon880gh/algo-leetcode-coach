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
            'message' => "Read the problem statement above.\nWhich row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The row with n − 1 ones', 'next' => 's2'],
                ['label' => 'The first row with any 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Beating one team is not enough; example 2 → 0 instead of 1.\nStep back to when you took the first 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rows or columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns with n − 1 ones', 'next' => 'wrong_b'],
                ['label' => 'Rows: grid[i][j] = 1 means i beats j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the team everyone beats; examples → 1 and 2 instead of 0 and 1.\nStep back to when you used columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
