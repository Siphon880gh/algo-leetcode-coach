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
            'message' => "Read the problem statement above.\nGenerate all 2^k codes and search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: collect windows', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(2^k · n).\nStep back to when you generated codes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Early exit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'wrong_b'],
                ['label' => 'If n − k + 1 < 2^k, false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Too few windows can never cover all codes.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rolling update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '((h << 1) | bit) & mask', 'next' => 'success'],
                ['label' => 'h << 1 without mask', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Old bits must fall off.\nStep back to when you dropped the mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"00110110\", 2 → true. \"0110\", 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
