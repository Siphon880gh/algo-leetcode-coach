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
            'message' => "Read the problem statement above.\nCheck every number from n upward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: generate palindromes directly', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Primes are sparse and the answer can be near 10⁸.\nStep back to when you scanned every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which lengths do you skip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd lengths', 'next' => 'wrong_b'],
                ['label' => 'Even lengths: they are divisible by 11', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An even-length palindrome has alternating digit sum 0, so 11 divides it.\nStep back to when you skipped odd lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then which n needs a special case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8 ≤ n ≤ 11 → 11, the only even-length palindromic prime', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Skipping even lengths also skips 11.\nStep back to when you dropped the special case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 6 → 7. 8 → 11. 13 → 101.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
