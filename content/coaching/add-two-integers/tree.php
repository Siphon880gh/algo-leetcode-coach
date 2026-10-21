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
            'message' => "Read the problem statement above.\nOperation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num1 + num2', 'next' => 's2'],
                ['label' => 'num1 − num2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 7 instead of 17.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add absolute values', 'next' => 'wrong_b'],
                ['label' => 'Same formula', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 14 instead of −6.\nStep back to when you dropped the signs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add by counting up one at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one addition', 'next' => 'success'],
                ['label' => 'Yes, loop num2 times', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With num2 = −5, a loop of num2 steps runs zero times and just returns num1.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 17, −6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
