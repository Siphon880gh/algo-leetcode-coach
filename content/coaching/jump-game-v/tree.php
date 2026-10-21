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
            'message' => "Read the problem statement above.\nCan you jump over a taller bar?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: stop scanning there', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every bar in between must be lower.\nStep back to when you jumped over it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal height?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Blocks the jump', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bars must be strictly lower.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max over all starts', 'next' => 'success'],
                ['label' => 'f(0)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You may start anywhere.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · d). First example → 4. [3,3,3,3,3] → 1. [7,6,5,4,3,2,1], d = 1 → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
