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
            'message' => "Read the problem statement above.\nCheck that each subject repeats c sessions later?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No, the counts are enough', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A student with A, B, C, C, B, A on six straight days is reported with cycle length 3.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minimum sessions in a run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c', 'next' => 'wrong_b'],
                ['label' => '2c (two full cycles)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A student with A, B, C on three straight days is reported.\nStep back to when you allowed one cycle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Bob Johnson 4, 26.0; Alice Chen 3, 15.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
