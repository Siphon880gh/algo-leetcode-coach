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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count every X on the board', 'next' => 'wrong_cells'],
                ['label' => 'Count one special X per ship: its top-left head', 'next' => 'head'],
            ],
        ],
        'wrong_cells' => [
            'message' => "You are wrong here. That counts cells, not ships. The example board has 4 X cells but 2 ships.\nStep back to when you counted every X.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'head' => [
            'message' => "Scan row by row, left to right. Skip dots.\nWhen is an X the head of its ship?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the cell above is not X and the cell to the left is not X', 'next' => 'cpx'],
                ['label' => 'Flood-fill each X with DFS and overwrite it with a dot', 'next' => 'wrong_dfs'],
            ],
        ],
        'wrong_dfs' => [
            'message' => "You are wrong for this follow-up. Flood fill (Number of Islands 200 style) gets the right count, but it writes to the board or needs a visited grid, and the follow-up forbids both.\nStep back to when you picked flood fill.",
            'outcome' => 'wrong',
            'rewind_to' => 'head',
            'choices' => [],
        ],
        'cpx' => [
            'message' => "Ships are straight and never touch, so each one has exactly one cell with no X above and no X to its left. Treat out-of-bounds as not X. One pass: O(m n) time, O(1) space, board untouched.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count X cells with no X above and no X to the left. Not 200', 'next' => 'success'],
                ['label' => 'Also check below and to the right before counting', 'next' => 'wrong_four'],
            ],
        ],
        'wrong_four' => [
            'message' => "You are wrong. Checking below or right would reject the head of any ship longer than 1, because its next cell is X. Only the cells already scanned (above and left) decide whether this X continues an earlier ship.\nStep back to when you added the extra neighbor checks.",
            'outcome' => 'wrong',
            'rewind_to' => 'cpx',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count an X only when the cell above and the cell to the left are not X. One pass, O(1) extra, no edits. X..X / ...X / ...X → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
