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
            'message' => "Problem: A table lists employees with their department and position. Find the department or departments with the most employees and report each one’s manager (the employee whose position marks them as the manager) with the department. The exact position value, names and ordering are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nReport whom?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each such department’s manager', 'next' => 's2'],
                ['label' => 'Every employee in it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The sample gives 6 rows instead of 2.\nStep back to when you skipped the manager filter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Departments tie for largest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep one (LIMIT 1)', 'next' => 'wrong_b'],
                ['label' => 'Keep all (= MAX)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sample ties departments 1 and 2, and one manager would be lost.\nStep back to when you used LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → the managers of departments 1 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
