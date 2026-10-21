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
            'message' => "Problem: An employee table maps each employee to a team. Report every employee with the size of their team. For instance, employees 1, 2, 3 in one team and employee 4 alone give sizes 3, 3, 3, and 1. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGROUP BY team alone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one row per employee is needed', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Grouping collapses employees.\nStep back to when you grouped the output.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window partition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'employee_id', 'next' => 'wrong_b'],
                ['label' => 'team_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each partition would have size 1.\nStep back to when you partitioned by employee.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Without windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Join to a grouped team count', 'next' => 'success'],
                ['label' => 'Count distinct teams', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That counts teams, not members.\nStep back to when you counted teams.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One window count, or a join to the grouped counts.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
