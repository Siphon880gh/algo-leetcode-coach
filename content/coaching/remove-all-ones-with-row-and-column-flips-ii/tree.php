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
            'message' => "Problem: Given a small binary grid (its total number of cells is at most 15), one operation picks a cell that holds 1 and sets every cell in its row and its column to 0. Return the minimum number of operations to make the grid all zeros. For instance, [[1,1,1],[1,1,1],[0,1,0]] → 2; [[0,1,0],[1,0,1],[0,1,0]] → 2; an all-zero grid → 0. (Restated from memory; limits and examples may differ slightly.)\nPick the cell clearing the most ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: BFS over masks', 'next' => 's2'],
                ['label' => 'Yes, greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[0,1,0],[1,1,0],[1,0,1]] takes 3 greedily, but 2 is possible.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cells can be picked?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any cell', 'next' => 'wrong_b'],
                ['label' => 'Only cells holding 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[0,1],[1,0]] → 2; picking the 0 at (0,0) would wrongly finish in 1.\nStep back to when you picked a 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does a move clear?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its whole row and its whole column', 'next' => 'success'],
                ['label' => 'Only its row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The operation clears both lines through the cell.\nStep back to when you cleared one line.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^(mn) · mn). Constructed cases → 2, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
