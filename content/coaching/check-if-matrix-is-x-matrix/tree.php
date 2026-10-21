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
            'message' => "Read the problem statement above.\nDiagonal cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i = j or i + j = n − 1', 'next' => 's2'],
                ['label' => 'i = j only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1’s anti-diagonal is non-zero → false instead of true.\nStep back to when you dropped i + j = n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only that everything else is zero', 'next' => 'wrong_b'],
                ['label' => 'Diagonal non-zero and everything else zero', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1,0,1],[0,0,0],[1,0,1]] has a zero centre → true instead of false.\nStep back to when you skipped the diagonal check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Centre cell for odd n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On a diagonal: must be non-zero', 'next' => 'success'],
                ['label' => 'Off both: must be zero', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[1,0,1],[0,5,0],[1,0,1]] → false instead of true.\nStep back to when you took the centre off the diagonal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
