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
            'message' => "Read the problem statement above.\nSimulate the operations on the matrix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: m and n go up to 4 · 10⁴, so look at the shapes', 'next' => 's2'],
                ['label' => 'Yes: add 1 to each rectangle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The matrix can have 1.6 · 10⁹ cells.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cells get every increment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The union of all the rectangles', 'next' => 'wrong_b'],
                ['label' => 'The intersection: min(a) × min(b), since every rectangle shares (0, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cell in the union may miss some operations; only cells inside every rectangle get them all.\nStep back to when you took the union.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There are no operations. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm × n: every cell is 0, so all of them tie', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks how many cells hold the max; with no operations every cell holds it.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Start from (m, n), take the min of each a and b, return the product: O(k) time. m = 3, n = 3, [[2,2],[3,3]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
