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
            'message' => "Problem: One table lists employees with a salary and a department. Return the employees who earn the second-highest salary in their department, including every employee tied at that salary. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DENSE_RANK', 'next' => 's2'],
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check that picks id 6 in B (a top earner) and drops id 3.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Salary order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'wrong_b'],
                ['label' => 'Descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The guide’s check → ids 2, 3, 5, 6 instead of 2, 3, 7 (checked in SQLite).\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → ids 2, 3, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
