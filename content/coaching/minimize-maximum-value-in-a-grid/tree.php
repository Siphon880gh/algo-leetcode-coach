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
            'message' => "Problem: You are given an m × n grid of distinct positive integers. Replace every value with a positive integer so that the relative order of any two values in the same row, and of any two values in the same column, stays the same, and the largest value in the new grid is as small as possible. Return the new grid. For instance, [[3,1],[2,5]] → [[2,1],[1,2]]; [[10]] → [[1]]. (Restated from memory; limits and examples may differ slightly.)\nVisit cells in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing original value', 'next' => 's2'],
                ['label' => 'Row by row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[3,1],[2,5]] → [[1,2],[2,3]], which flips 3 and 1.\nStep back to when you went row by row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rowMax + 1', 'next' => 'wrong_b'],
                ['label' => 'max(rowMax, colMax) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Columns are ignored; [[2,4,5],[7,6,1]] → [[1,2,3],[3,2,1]], tying 4 and 6.\nStep back to when you used only the row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After writing x, update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both rowMax and colMax', 'next' => 'success'],
                ['label' => 'Only rowMax', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[2,4,5],[7,6,1]] → [[1,2,3],[3,2,1]], tying 4 and 6.\nStep back to when you skipped colMax.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Constructed checks → [[2,1],[1,2]], [[1,2,3],[4,3,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
