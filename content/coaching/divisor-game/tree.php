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
            'message' => "Read the problem statement above.\nFrom odd n, what parity can the next number have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only even', 'next' => 's2'],
                ['label' => 'Either', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every divisor of an odd number is odd, and odd − odd is even.\nStep back to when you said either.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From even n, what is a safe move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract the largest divisor', 'next' => 'wrong_b'],
                ['label' => 'Subtract 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That can leave an even number to the opponent.\nStep back to when you took the largest divisor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "So when does Alice win?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When n is even', 'next' => 'success'],
                ['label' => 'When n is prime', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Primes above 2 are odd, and Alice loses those.\nStep back to when you said prime.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). n = 2 → true. n = 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
