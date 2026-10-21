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
            'message' => "Read the problem statement above.\nSize order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest first, stop at the first hit', 'next' => 's2'],
                ['label' => 'Smallest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You would scan every size before knowing the answer.\nStep back to when you went small to large.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lines to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows and columns only', 'next' => 'wrong_b'],
                ['label' => 'All rows, all columns, both diagonals', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The diagonals must match too.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Nothing larger works?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every 1 × 1 grid is magic.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
