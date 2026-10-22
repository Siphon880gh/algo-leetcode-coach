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
            'message' => "Read the problem statement above.\nx runs up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2, inclusive', 'next' => 's2'],
                ['label' => 'Strictly below n / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x = y is allowed; example 1 → [[3, 7]] instead of [[3, 7], [5, 5]].\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test primality with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trial division for each x', 'next' => 'wrong_b'],
                ['label' => 'A sieve up to n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For n = 10^6 that is about 5 · 10^5 values times up to 1000 divisors each, near 10^9 steps.\nStep back to when you used trial division.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log log n). Examples → [[3, 7], [5, 5]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
