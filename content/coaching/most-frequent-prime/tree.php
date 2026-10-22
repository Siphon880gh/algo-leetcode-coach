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
            'message' => "Read the problem statement above.\nWhich numbers count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Primes greater than 10', 'next' => 's2'],
                ['label' => 'Every prime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 7 instead of −1.\nStep back to when you counted one-digit primes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest prime', 'next' => 'wrong_b'],
                ['label' => 'Largest prime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 47 instead of 97.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 19, −1, 97.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
