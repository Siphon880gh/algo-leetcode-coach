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
            'message' => "Read the problem statement above.\nTest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'product = gcd · lcm', 'next' => 's2'],
                ['label' => 'product = lcm', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 2] → 1 instead of 2.\nStep back to when you dropped the gcd.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pairwise coprime only', 'next' => 'wrong_b'],
                ['label' => 'Any values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 2] → 1 instead of 2 (4 = 2 · 2).\nStep back to when you required coprime.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 5, 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
