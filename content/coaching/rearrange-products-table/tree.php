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
            'message' => "Read the problem statement above.\nDrop missing prices how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE storeX IS NOT NULL', 'next' => 's2'],
                ['label' => 'WHERE storeX <> NULL', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Comparisons with NULL are never true.\nStep back to when you used <> NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'JOIN', 'next' => 'wrong_b'],
                ['label' => 'UNION ALL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. We stack rows, not columns.\nStep back to when you joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store column value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A string literal per branch', 'next' => 'success'],
                ['label' => 'The column name dynamically', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. SQL needs the literal in each branch.\nStep back to when you went dynamic.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Example → five rows.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
