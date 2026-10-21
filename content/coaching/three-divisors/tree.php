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
            'message' => "Read the problem statement above.\nShape of n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p² for a prime p', 'next' => 's2'],
                ['label' => 'Any perfect square', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 16 has five divisors.\nStep back to when you accepted all squares.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'True', 'next' => 'wrong_b'],
                ['label' => 'False (one divisor)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 has only itself as a divisor.\nStep back to when you accepted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prime test range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to √r', 'next' => 'success'],
                ['label' => 'Up to r', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Divisors pair up at √r.\nStep back to when you scanned to r.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
