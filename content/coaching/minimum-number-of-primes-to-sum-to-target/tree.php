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
            'message' => "Problem: Given n and m, pick primes from the first m primes, each usable any number of times, so that they sum to exactly n. Return the fewest primes needed, or −1 if it cannot be done. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCoins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first m primes', 'next' => 's2'],
                ['label' => 'Every prime up to n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 9, m = 1 → 2 instead of −1.\nStep back to when you used all primes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest prime first', 'next' => 'wrong_b'],
                ['label' => 'DP over sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 4, m = 2 → −1 instead of 2.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Checks → −1, 4, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
