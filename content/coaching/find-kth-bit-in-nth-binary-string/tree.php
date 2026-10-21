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
            'message' => "Read the problem statement above.\nMirror position for k > mid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^n − k', 'next' => 's2'],
                ['label' => 'k − mid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The right half is reversed.\nStep back to when you shifted instead of mirroring.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Right-half bit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same', 'next' => 'wrong_b'],
                ['label' => 'Inverted', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right half is inverted too.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n = 1 → 0', 'next' => 'success'],
                ['label' => 'n = 1 → 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. S1 = 0.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). (3, 1) → 0. (4, 11) → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
