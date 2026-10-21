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
            'message' => "Read the problem statement above.\nTest a row how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n distinct values', 'next' => 's2'],
                ['label' => 'Sum equals n(n + 1) / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [2,2,2] sums to 6 for n = 3 but misses 1 and 3.\nStep back to when you compared sums.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rows all valid. Done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, check columns too', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1,2,3],[1,2,3],[1,2,3]] has valid rows but each column repeats one value.\nStep back to when you skipped columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A line with a repeated value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invalid: with n cells, some number is missing', 'next' => 'success'],
                ['label' => 'Valid if values stay in 1 … n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n cells holding a repeat cannot also hold all n numbers.\nStep back to when you accepted it.",
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
