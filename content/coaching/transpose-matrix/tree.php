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
            'message' => "Read the problem statement above.\nSwap across the diagonal in place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the matrix may not be square', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 2 × 3 matrix has a 3 × 2 transpose.\nStep back to when you swapped in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What shape is the result for an m × n input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm × n', 'next' => 'wrong_b'],
                ['label' => 'n × m', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rows become columns.\nStep back to when you kept the shape.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fill rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'res[j][i] = matrix[i][j]', 'next' => 'success'],
                ['label' => 'res[i][j] = matrix[j][i] with the same loops', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With i < m and j < n, matrix[j][i] can be out of range.\nStep back to when you swapped the source indices.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[1,2,3],[4,5,6],[7,8,9]] → [[1,4,7],[2,5,8],[3,6,9]]. [[1,2,3],[4,5,6]] → [[1,4],[2,5],[3,6]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
