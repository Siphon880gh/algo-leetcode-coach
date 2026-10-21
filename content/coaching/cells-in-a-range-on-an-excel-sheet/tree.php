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
            'message' => "Read the problem statement above.\nOuter loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns', 'next' => 's2'],
                ['label' => 'Rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 would give K1, L1, K2, L2 instead of K1, K2, L1, L2.\nStep back to when you put rows outside.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'End excluded', 'next' => 'wrong_b'],
                ['label' => 'Both ends included', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 must include F1.\nStep back to when you excluded the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build each cell string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column letter, then row digit', 'next' => 'success'],
                ['label' => 'Row digit, then column letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cells are written column first, then row: K1, not 1K.\nStep back to when you put the row first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(cells). Examples → [K1,K2,L1,L2], [A1,…,F1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
