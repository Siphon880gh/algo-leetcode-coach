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
            'message' => "Read the problem statement above.\nA streak of 3 days scores how much?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + 2 + 3 = 6', 'next' => 's2'],
                ['label' => '3 + 3 + 3 = 9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Points grow 1, 2, 3 inside a streak. A flat rate would let n = 9 finish in 3 days instead of 6.\nStep back to when you used a flat rate.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "In the knapsack, what does a streak of j days cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j days', 'next' => 'wrong_b'],
                ['label' => 'j + 1 days, with f[0] = −1 for the last streak', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each streak but the last needs a skip to reset. Charging j days gives 2 instead of 3 for n = 2.\nStep back to when you dropped the skip.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Unbounded knapsack over triangular streaks. O(n√n). Examples give 3, 6 and 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
