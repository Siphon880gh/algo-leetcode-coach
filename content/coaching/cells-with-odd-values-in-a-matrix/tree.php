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
            'message' => "Read the problem statement above.\nSimulate the whole matrix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Possible, but parity counts are enough', 'next' => 's2'],
                ['label' => 'Only option', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the parity of each row and column matters.\nStep back to when you insisted on simulating.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cell (r, c) is odd when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both are odd', 'next' => 'wrong_b'],
                ['label' => 'Exactly one of row r and column c is odd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two odd toggles make an even value.\nStep back to when you required both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'R · (n − C) + (m − R) · C', 'next' => 'success'],
                ['label' => 'R · n + C · m', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That counts cells in an odd row and odd column as odd.\nStep back to when you added both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n + indices). m = 2, n = 3, [[0,1],[1,1]] → 6. m = 2, n = 2, [[1,1],[0,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
