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
            'message' => "Read the problem statement above.\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Π L minus totals below k', 'next' => 's2'],
                ['label' => 'Π L', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 16 instead of 5.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "DP step per run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over every length 1 … L', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums over the last L values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. About 5 · 10^5 · 2000 = 10^9 steps.\nStep back to when you looped over lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k²). Examples → 5, 1, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
