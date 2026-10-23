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
            'message' => "Read the problem statement above.\nUse the split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, primes on both sides count twice', 'next' => 's2'],
                ['label' => 'No, count primes in the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 2] instead of [3, 4].\nStep back to when you ignored the split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Splits where a prime counts twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'first ≤ k ≤ last', 'next' => 'wrong_b'],
                ['label' => 'first < k ≤ last', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [4, 4] instead of [3, 4].\nStep back to when you included k = first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [3, 4], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
