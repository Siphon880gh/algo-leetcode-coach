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
            'message' => "Problem: A table Data has two integer columns, first_col and second_col. Return a result with the same number of rows where first_col is sorted in ascending order and second_col is sorted in descending order, each sorted independently of the other. For instance, rows (4, 2), (2, 3), (3, 1), (1, 4) → (1, 4), (2, 3), (3, 2), (4, 1). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOne ORDER BY?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort each column on its own', 'next' => 's2'],
                ['label' => 'ORDER BY first_col, second_col DESC', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That keeps each row together; the constructed example comes out (1, 4), (2, 3), (3, 1), (4, 2) instead of ending (3, 2), (4, 1).\nStep back to when you used one ORDER BY.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair the sorted columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cross join the two lists', 'next' => 'wrong_b'],
                ['label' => 'Join on the row number', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cross join makes n² rows.\nStep back to when you cross joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Numbering function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER', 'next' => 'success'],
                ['label' => 'RANK', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values get the same rank, so the join would pair them with several rows.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed example → (1, 4), (2, 3), (3, 2), (4, 1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
