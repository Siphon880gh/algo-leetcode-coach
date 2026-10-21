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
            'message' => "Read the problem statement above.\nThe two sides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Independent: square one side', 'next' => 's2'],
                ['label' => 'No houses opposite each other', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Opposite houses are allowed; Example 1 → 3 instead of 4.\nStep back to when you banned opposite houses.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One side of n plots?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^n subsets', 'next' => 'wrong_b'],
                ['label' => 'Fibonacci: f(n) = f(n − 1) + f(n − 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows adjacent houses; Example 2 → 16 instead of 9.\nStep back to when you used 2^n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Squaring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce, then square in 64-bit', 'next' => 'success'],
                ['label' => 'Square in 32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The reduced count can be near 10^9, so its square is near 10^18.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
