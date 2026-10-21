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
            'message' => "Read the problem statement above.\nAre dominoes alone enough to model it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: trominoes create half-filled columns', 'next' => 's2'],
                ['label' => 'Yes: it is Fibonacci', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Fibonacci counts domino tilings only.\nStep back to when you ignored trominoes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What closed recurrence results?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[n] = dp[n − 1] + 2 · dp[n − 2]', 'next' => 'wrong_b'],
                ['label' => 'dp[n] = 2 · dp[n − 1] + dp[n − 3]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Check it: dp[3] must be 5, and 2 · 2 + 1 = 5.\nStep back to when you used that recurrence.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What are the base cases?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0] = 1, dp[1] = 1, dp[2] = 2', 'next' => 'success'],
                ['label' => 'dp[0] = 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The empty board has one tiling.\nStep back to when you set dp[0] = 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) mod 10⁹ + 7. n = 3 → 5. n = 1 → 1. n = 4 → 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
