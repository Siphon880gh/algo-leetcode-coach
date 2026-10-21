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
            'message' => "Read the problem statement above.\nEmployees with no manager (manager_id NULL)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exclude them', 'next' => 's2'],
                ['label' => 'Include them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An employee with no manager has no manager who left.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Salary filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 30000', 'next' => 'wrong_b'],
                ['label' => 'Strictly less than 30000', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The bound is strict.\nStep back to when you used <=.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How to test that the manager left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'manager_id NOT IN employee ids', 'next' => 'success'],
                ['label' => 'An INNER JOIN on manager_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An inner join keeps only managers who are still there.\nStep back to when you joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
