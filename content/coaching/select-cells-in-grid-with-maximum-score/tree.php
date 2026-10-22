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
            'message' => "Read the problem statement above.\nStrategy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP on (value, row mask)', 'next' => 's2'],
                ['label' => 'Each row’s largest unused value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 11 instead of 15.\nStep back to when you went greedy per row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After taking value v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allow v again from another row', 'next' => 'wrong_b'],
                ['label' => 'Move to the next distinct value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values must be unique: example 2 → 16 instead of 15.\nStep back to when you allowed v again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(100 · 2^10 · 10). Examples → 8, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
