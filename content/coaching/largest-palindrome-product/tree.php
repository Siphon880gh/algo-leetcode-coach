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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Enumerate palindromes from largest down and test each for a factor pair', 'next' => 's2'],
                ['label' => 'Multiply every pair of n-digit numbers and keep the largest palindrome', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For n = 8 that is 10^16 products. Far too many.\nStep back to when you multiplied all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left half a from 10^n − 1 down. Mirror it into p (99 → 9999).\nHow do you test p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every t from 1 up to 10^n − 1', 'next' => 'wrong_b'],
                ['label' => 'Try t from 10^n − 1 down while t × t >= p; if p % t == 0, done', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Factors below t² < p cannot pair with another n-digit factor, and testing every t down to 1 wastes time.\nStep back to when you tested all divisors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The first palindrome with a valid factor is the answer; return p % 1337. n = 1 is special: 9. Use 64-bit integers; p reaches about 10^16.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mirror halves top-down, factor test with t² ≥ p, mod at the end', 'next' => 'success'],
                ['label' => 'Reduce each palindrome mod 1337 before testing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Taking mod 1337 before you know p is a valid product scrambles the comparison and the factor test.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Largest palindromes first, factor test down to sqrt, mod at the end. n = 2 → 987.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
