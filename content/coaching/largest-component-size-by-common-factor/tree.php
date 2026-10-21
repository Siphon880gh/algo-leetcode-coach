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
            'message' => "Read the problem statement above.\nCompare every pair with gcd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: union each number with its prime factors', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) gcds for n up to 2·10⁴.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Union with all divisors or only primes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All divisors', 'next' => 'wrong_b'],
                ['label' => 'Only primes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any shared factor > 1 implies a shared prime, so primes are enough.\nStep back to when you used all divisors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Numbers from nums per root', 'next' => 'success'],
                ['label' => 'All nodes per root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Prime nodes are helpers, not part of the answer.\nStep back to when you counted primes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). [4,6,15,35] → 4. [20,50,9,63] → 2. [2,3,6,7,4,12,21,39] → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
