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
            'message' => "Read the problem statement above.\nAfter dividing by every p with p² ≤ x, x > 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add x; it is prime', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The leftover is a prime factor; Example 1 → 1 instead of 4.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the elements’ primes how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add up each element’s count', 'next' => 'wrong_b'],
                ['label' => 'One shared set', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shared primes would count again; Example 2 → 4 instead of 1.\nStep back to when you summed counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). Examples → 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
