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
            'message' => "Read the problem statement above.\nCheck gcd for each query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: union by shared divisors up front', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A path may use intermediate cities.\nStep back to when you used a direct gcd.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which divisors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'z from 1', 'next' => 'wrong_b'],
                ['label' => 'z from threshold + 1 to n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Divisors ≤ threshold do not create roads.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total union work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ n / z = O(n log n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is a harmonic series.\nStep back to when you estimated n².",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [false,false,true], all true, all false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
