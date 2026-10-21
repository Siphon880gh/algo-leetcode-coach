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
            'message' => "Problem: A project table links projects to employees, and an employee table records each employee's years of experience. For every project, report the most experienced employee or employees on it, including ties. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich window function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK()', 'next' => 's2'],
                ['label' => 'ROW_NUMBER()', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ROW_NUMBER keeps one employee even when several tie.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Partition by what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'employee_id', 'next' => 'wrong_b'],
                ['label' => 'project_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The ranking is inside each project.\nStep back to when you partitioned by employee.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order the ranking by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'experience_years DESC', 'next' => 'success'],
                ['label' => 'experience_years ASC', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rank 1 must be the most experienced.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Each project returns all of its most experienced employees.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
