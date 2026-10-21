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
            'message' => "Read the problem statement above.\nRescan row and column per one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(mn(m + n)).\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'row[i] = 1 only', 'next' => 'wrong_b'],
                ['label' => 'mat[i][j] = 1, row[i] = 1, col[j] = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The column must be clean too.\nStep back to when you checked only the row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(m · n)', 'next' => 'success'],
                ['label' => 'O((m · n)²)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two passes over the grid suffice.\nStep back to when you estimated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example 1 → 1. Identity 3 × 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
