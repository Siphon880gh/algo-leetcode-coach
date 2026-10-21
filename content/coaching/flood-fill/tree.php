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
            'message' => "Read the problem statement above.\nThe new color equals the original. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the image unchanged', 'next' => 's2'],
                ['label' => 'Run the fill anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Recolored cells would still match the original, so the fill never ends.\nStep back to when you ran the fill.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Do you need a separate visited grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: recoloring marks the cell', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Once recolored, a cell no longer matches the original color.\nStep back to when you added a visited grid.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which neighbors spread the fill?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The 4 orthogonal ones', 'next' => 'success'],
                ['label' => 'All 8', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Connection is 4-directional.\nStep back to when you used diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[1,1,1],[1,1,0],[1,0,1]], (1, 1), color 2 → [[2,2,2],[2,2,0],[2,0,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
