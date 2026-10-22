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
            'message' => "Read the problem statement above.\nSpecial numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p² for a prime p', 'next' => 's2'],
                ['label' => 'Every perfect square', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 16 has three proper divisors: example 2 → 10 instead of 11.\nStep back to when you took every square.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sieve up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r', 'next' => 'wrong_b'],
                ['label' => '√r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is a 10^9-entry sieve.\nStep back to when you sieved to r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√r log log r). Examples → 3, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
