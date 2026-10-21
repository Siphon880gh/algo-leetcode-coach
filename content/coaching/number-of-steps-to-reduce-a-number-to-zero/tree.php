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
            'message' => "Read the problem statement above.\nOdd number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract 1', 'next' => 's2'],
                ['label' => 'Halve', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only even numbers are halved.\nStep back to when you halved it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bit formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bitLength + popcount', 'next' => 'wrong_b'],
                ['label' => 'bitLength + popcount − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The top bit needs no halving.\nStep back to when you dropped the −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "num = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 steps', 'next' => 'success'],
                ['label' => '1 step', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is already zero.\nStep back to when you counted a step.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log num). 14 → 6. 8 → 4. 123 → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
