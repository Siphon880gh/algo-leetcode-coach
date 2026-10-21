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
            'message' => "Problem: A project table links projects to employees, and an employee table describes the employees. Report every project that has the largest number of employees, including ties. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nORDER BY count DESC LIMIT 1 on the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: ties would be dropped', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Several projects can share the top count.\nStep back to when you used LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which count per project?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(experience_years)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(*) from Project', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The question is about headcount.\nStep back to when you summed experience.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compare with the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING COUNT(*) = the largest grouped count', 'next' => 'success'],
                ['label' => 'WHERE COUNT(*) = MAX(…)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Aggregates cannot go in WHERE.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. All projects sharing the top headcount are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
