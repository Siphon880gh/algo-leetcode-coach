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
            'message' => "Read the problem statement above.\nWhen can you reshape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if m × n == r × c; otherwise return mat unchanged', 'next' => 's2'],
                ['label' => 'Always: pad or cut to fit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Different element counts make the reshape illegal, and the problem says to return the original.\nStep back to when you padded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does element (i, j) of mat go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It stays at (i, j) when that fits', 'next' => 'wrong_b'],
                ['label' => 'Flat index k = i × n + j, then (k // c, k % c)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Row-major order must be kept: [[1,2],[3,4]] → 1 × 4 is [[1,2,3,4]], so 3 moves from (1, 0) to (0, 2).\nStep back to when you kept positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which width do you divide k by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n for the source, c for the target', 'next' => 'success'],
                ['label' => 'c for both', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Dividing by c on the source reads the wrong cells; read mat at (k // n, k % n) and write at (k // c, k % c).\nStep back to when you used one width.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One flat index ties the two shapes: O(m · n) time and space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
