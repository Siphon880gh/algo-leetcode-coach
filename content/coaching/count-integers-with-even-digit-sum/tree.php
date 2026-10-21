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
            'message' => "Read the problem statement above.\nAnswer as num / 2 always?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: depends on num’s digit sum', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 (30) → 14, not 15; 3 + 0 is odd.\nStep back to when you ignored num’s parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … num − 1', 'next' => 'wrong_b'],
                ['label' => '1 … num inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 counts 4 itself: → 2, not 1.\nStep back to when you excluded num.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Digit sum of num even?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num / 2', 'next' => 'success'],
                ['label' => '(num − 1) / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 (4, digit sum 4) → 2, not 1.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log num). Examples → 2, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
