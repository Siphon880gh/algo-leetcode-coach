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
            'message' => "Read the problem statement above.\nTry all groups of four points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two diagonal corners determine the other two', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n⁴).\nStep back to when you took quadruples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pairs can be diagonals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any pair', 'next' => 'wrong_b'],
                ['label' => 'Pairs with different x and different y', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A pair on the same row or column has zero area.\nStep back to when you used any pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No rectangle is found. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '−1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,1],[1,3],[3,1],[3,3],[2,2]] → 4. [[1,1],[1,3],[3,1],[3,3],[4,1],[4,3]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
