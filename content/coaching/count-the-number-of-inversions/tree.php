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
            'message' => "Read the problem statement above.\nThe element at index i adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … i inversions', 'next' => 's2'],
                ['label' => '0 … n − 1 inversions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only i earlier elements exist: example 1 → 3 instead of 2.\nStep back to when you allowed n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Requirements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check only the last one', 'next' => 'wrong_b'],
                ['label' => 'Zero every other count at each end index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 2 instead of 1.\nStep back to when you kept only the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 400), with prefix sums. Examples → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
