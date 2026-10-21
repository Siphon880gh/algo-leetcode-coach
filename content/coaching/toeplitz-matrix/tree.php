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
            'message' => "Read the problem statement above.\nCollect each diagonal into a list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare each cell with matrix[r − 1][c − 1]', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works but uses extra space; the neighbor check suffices.\nStep back to when you collected diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cells do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All cells', 'next' => 'wrong_b'],
                ['label' => 'r ≥ 1 and c ≥ 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first row and column start the diagonals and have no upper-left neighbor.\nStep back to when you checked all cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Only one row fits in memory. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare row[1:] with the previous row[:-1]', 'next' => 'success'],
                ['label' => 'Load the whole matrix anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each row only needs the one before it.\nStep back to when you loaded everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n) time, O(1) space. [[1,2,3,4],[5,1,2,3],[9,5,1,2]] → true. [[1,2],[2,2]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
