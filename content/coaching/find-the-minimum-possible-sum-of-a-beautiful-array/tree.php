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
            'message' => "Read the problem statement above.\nAfter 1 … target // 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump to target', 'next' => 's2'],
                ['label' => 'Keep going from target // 2 + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pairs reach target; example 2 → 6 with 1 + 2 = 3.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum the numbers with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A loop', 'next' => 'wrong_b'],
                ['label' => 'Arithmetic series formulas', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n reaches 10^9, far too many iterations.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 4, 8, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
