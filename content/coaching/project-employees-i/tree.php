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
            'message' => "Read the problem statement above.\nWhere does experience_years come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Employee, joined on employee_id', 'next' => 's2'],
                ['label' => 'Project', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Project only links ids.\nStep back to when you read it from Project.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'employee_id', 'next' => 'wrong_b'],
                ['label' => 'project_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The average is per project.\nStep back to when you grouped by employee.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output format for the average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(AVG(experience_years), 2)', 'next' => 'success'],
                ['label' => 'AVG without rounding', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for two digits.\nStep back to when you skipped rounding.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with a hash join. Each project appears once with its average experience.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
