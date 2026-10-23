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
            'message' => "State:\nN = 4\nboard (empty):\n. . . .\n. . . .\n. . . .\n. . . .\n\nPlace one queen per row. Put the first queen with me at (0, 1):\n\n. Q . .\n. . . .\n. . . .\n. . . .\n\nWhich columns in row 1 are under attack from that queen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns 0, 1, and 2 — only column 3 is safe', 'next' => 'place13'],
                ['label' => 'Only column 1 — diagonals do not matter yet', 'next' => 'w_diag'],
            ],
        ],
        'w_diag' => [
            'message' => "Wrong.\n\nFrom (0, 1) the queen also hits:\n- ↙ diagonal → (1, 0)\n- column 1 → (1, 1)\n- ↘ diagonal → (1, 2)\n\nSo row 1 columns 0, 1, and 2 are banned.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'place13' => [
            'message' => "State:\nN = 4\nplaced = (0, 1)\nrow = 1\n\nOnly column 3 is free. Place (1, 3):\n\n. Q . .\n. . . Q\n. . . .\n. . . .\n\nFor row 2, which column can you try first without sharing a column or diagonal with those two queens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column 0 — columns 1 and 3 taken; column 2 on a diagonal from (0, 1)', 'next' => 'place20'],
                ['label' => 'Column 2 — looks open in the middle', 'next' => 'w_r2diag'],
            ],
        ],
        'w_r2diag' => [
            'message' => "Wrong.\n\n(2, 2) and (0, 1) share the ↘ key r − c = −1. Column 2 is banned by that diagonal.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place13',
            'choices' => [],
        ],
        'place20' => [
            'message' => "State:\nplaced = (0, 1), (1, 3), (2, 0)\nboard:\n. Q . .\n. . . Q\nQ . . .\n. . . .\n\nRow 3: which column finishes a valid board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column 2 → (3, 2)', 'next' => 'full'],
                ['label' => 'Column 1 → (3, 1)', 'next' => 'w_r3'],
            ],
        ],
        'w_r3' => [
            'message' => "Wrong.\n\nColumn 1 already has the queen at (0, 1). Row 3 only has column 2 free under the bans.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place20',
            'choices' => [],
        ],
        'full' => [
            'message' => "State:\nsolution board:\n. Q . .\n. . . Q\nQ . . .\n. . Q .\n\npositions = (0, 1), (1, 3), (2, 0), (3, 2)\n\nTo answer “can I place at (r, c)?” in O(1), what do you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Used columns, plus both diagonal keys (r − c and r + c)', 'next' => 'success'],
                ['label' => 'Only used columns — diagonals can be checked later', 'next' => 'w_sets'],
            ],
        ],
        'w_sets' => [
            'message' => "Wrong.\n\nColumns alone miss diagonal attacks. Keep three bans: col, r − c, and r + c (sets or bitmasks).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'full',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Start from an empty board; one queen per row\n- See attacks on the grid (column + both diagonals)\n- Store those three bans; backtrack when a row has no free column\n\nN=4 reaches boards like the one you built.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
