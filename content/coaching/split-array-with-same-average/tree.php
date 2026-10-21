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
            'message' => "Read the problem statement above.\nTry every subset?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: 2³⁰ subsets is too many', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Reduce to subset sums by size instead.\nStep back to when you enumerated subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A part of size k must have which sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total / 2', 'next' => 'wrong_b'],
                ['label' => 'total · k / n, which must be an integer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal averages do not mean equal sums.\nStep back to when you halved the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which sizes k do you need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … n // 2: the smaller part is enough', 'next' => 'success'],
                ['label' => 'All of 1 … n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If one part works, so does its complement, so the smaller size suffices.\nStep back to when you checked every size.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sums per size with sets or bitsets. [1,2,3,4,5,6,7,8] → true. [3,1] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
