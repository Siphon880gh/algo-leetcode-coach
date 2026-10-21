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
            'message' => "Read the problem statement above.\nCan segments share endpoints?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement allows touching segments.\nStep back to when you forbade sharing.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(n, 2k)', 'next' => 'wrong_b'],
                ['label' => 'C(n + k − 1, 2k)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That forbids shared endpoints; n = 4, k = 2 would give 1, not 5.\nStep back to when you used C(n, 2k).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Large values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce mod 1e9+7', 'next' => 'success'],
                ['label' => 'Exact integers in 32 bits', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 30, k = 7 already needs the modulo.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 5, 3, 796297179.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
