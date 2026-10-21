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
            'message' => "Read the problem statement above.\nA part starts with 0 and has more digits. Valid forms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only "0." + the rest, and only if it does not end in 0', 'next' => 's2'],
                ['label' => 'Any decimal placement', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"01\" and \"01.5\" have a leading zero.\nStep back to when you allowed any placement.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A part ends with 0 and has more digits. Valid forms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any decimal placement', 'next' => 'wrong_b'],
                ['label' => 'Only the integer, if it has no leading zero', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A decimal like \"1.0\" or \"10.0\" ends in a trailing zero.\nStep back to when you allowed decimals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is each answer written?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"(x, y)" with a space after the comma', 'next' => 'success'],
                ['label' => '"(x,y)"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output format includes the space.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). \"(123)\" → [\"(1, 2.3)\",\"(1, 23)\",\"(1.2, 3)\",\"(12, 3)\"]. \"(00011)\" → [\"(0, 0.011)\",\"(0.001, 1)\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
