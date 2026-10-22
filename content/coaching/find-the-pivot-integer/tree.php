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
            'message' => "Read the problem statement above.\nTotal of 1 … n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n + 1) / 2', 'next' => 's2'],
                ['label' => 'n² / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 32 instead of 36, and −1 instead of 6.\nStep back to when you used n² / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The total is not a perfect square?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return its rounded-down square root', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No pivot exists then; Example 3 (n = 4, total 10) → 3 instead of −1.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 6, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
