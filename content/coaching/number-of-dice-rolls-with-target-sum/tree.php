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
            'message' => "Read the problem statement above.\nUpdate dp in place for a die?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a new row', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The same die would be counted several times.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "new[s]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[s] + Σ dp[s − f]', 'next' => 'wrong_b'],
                ['label' => 'Σ dp[s − f] for f in 1..k with s − f ≥ 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every die must show a face.\nStep back to when you kept dp[s].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Large counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce mod 10⁹ + 7 each step', 'next' => 'success'],
                ['label' => 'Reduce once at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Intermediate counts overflow.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · target · k). n = 1, k = 6, target = 3 → 1. n = 2, k = 6, target = 7 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
