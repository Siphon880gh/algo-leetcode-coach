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
            'message' => "Read the problem statement above.\nCount of nice divisors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product of the exponents', 'next' => 's2'],
                ['label' => 'Product of (exponent + 1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each prime must appear at least once, so exponent choices are 1 … e.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remainder 1 after dividing by 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by 1', 'next' => 'wrong_b'],
                ['label' => 'Use one 4 instead of 3 + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2 · 2 = 4 beats 3 · 1 = 3.\nStep back to when you kept the 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "primeFactors up to 10^9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Modular exponentiation', 'next' => 'success'],
                ['label' => 'Loop multiplying 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is up to 3 · 10^8 multiplications.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log p). Examples → 6, 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
