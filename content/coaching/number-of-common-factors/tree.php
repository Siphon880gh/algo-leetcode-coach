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
            'message' => "Read the problem statement above.\nCount divisors of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd(a, b)', 'next' => 's2'],
                ['label' => 'min(a, b)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 25 does not divide 30; Example 2 → 3 instead of 2.\nStep back to when you used the smaller number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range of x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … g − 1', 'next' => 'wrong_b'],
                ['label' => '1 … g inclusive', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. g divides itself; Example 1 → 3 instead of 4.\nStep back to when you stopped before g.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(g). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
