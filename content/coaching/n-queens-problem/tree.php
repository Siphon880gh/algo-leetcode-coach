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
            'message' => "State:\nN = 4\nthe board is empty:\n. . . .\n. . . .\n. . . .\n. . . .\n\nPlace one queen per row. Put the first queen at (0, 1):\n\n. Q . .\n. . . .\n. . . .\n. . . .\n\nWhich columns in row 1 does that queen attack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns 0, 1 and 2, so only column 3 is safe', 'next' => 'place13'],
                ['label' => 'Only column 1, because diagonals do not matter yet', 'next' => 'w_diag'],
            ],
        ],
        'w_diag' => [
            'message' => "Wrong.\n\nFrom (0, 1), the queen also attacks:\n- the down-left diagonal, at (1, 0)\n- column 1, at (1, 1)\n- the down-right diagonal, at (1, 2)\n\nSo columns 0, 1 and 2 in row 1 are banned.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'place13' => [
            'message' => "State:\nN = 4\nplaced: (0, 1)\nrow = 1\n\nOnly column 3 is free, so place (1, 3):\n\n. Q . .\n. . . Q\n. . . .\n. . . .\n\nIn row 2, which column can you try first without sharing a column or diagonal with those two queens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column 0. Columns 1 and 3 are taken, and column 2 is on a diagonal from (0, 1).', 'next' => 'place20'],
                ['label' => 'Column 2, because the middle looks open', 'next' => 'w_r2diag'],
            ],
        ],
        'w_r2diag' => [
            'message' => "Wrong.\n\n(2, 2) and (0, 1) share the down-right key r − c = −1, so that diagonal bans column 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place13',
            'choices' => [],
        ],
        'place20' => [
            'message' => "State:\nplaced: (0, 1), (1, 3), (2, 0)\nboard:\n. Q . .\n. . . Q\nQ . . .\n. . . .\n\nIn row 3, which column completes a valid board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column 2, at (3, 2)', 'next' => 'full'],
                ['label' => 'Column 1, at (3, 1)', 'next' => 'w_r3'],
            ],
        ],
        'w_r3' => [
            'message' => "Wrong.\n\nColumn 1 already has the queen at (0, 1). With the bans, only column 2 is free in row 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place20',
            'choices' => [],
        ],
        'full' => [
            'message' => "State:\nthe solution board:\n. Q . .\n. . . Q\nQ . . .\n. . Q .\n\npositions: (0, 1), (1, 3), (2, 0), (3, 2)\n\nTo answer \"can I place a queen at (r, c)?\" in O(1), what do you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The used columns, plus both diagonal keys (r − c and r + c)', 'next' => 'success'],
                ['label' => 'Only the used columns, and check diagonals later', 'next' => 'w_sets'],
            ],
        ],
        'w_sets' => [
            'message' => "Wrong.\n\nColumns alone miss diagonal attacks. Keep three sets of bans, for the column, r − c and r + c. Sets or bitmasks both work.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'full',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Start from an empty board and place one queen per row.\n- Mark the attacks on the grid: the column and both diagonals.\n- Store those three bans, and backtrack when a row has no free column.\n\nFor N = 4, this reaches boards like the one you built.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
