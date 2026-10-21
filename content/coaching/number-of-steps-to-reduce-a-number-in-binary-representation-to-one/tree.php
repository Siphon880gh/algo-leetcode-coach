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
            'message' => "Read the problem statement above.\nConvert to an integer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: up to 500 bits', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The value is far too large for built-in types in many languages.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Effective bit 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 step', 'next' => 'wrong_b'],
                ['label' => '2 steps, carry = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Odd means add 1, then halve.\nStep back to when you counted one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leading bit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not processed; add the final carry', 'next' => 'success'],
                ['label' => 'Processed like the rest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The number stops at 1.\nStep back to when you processed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"1101\" → 6. \"10\" → 1. \"1\" → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
