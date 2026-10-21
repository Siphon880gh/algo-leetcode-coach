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
            'message' => "Problem: A departments table lists valid departments, and a students table gives each student a department id. Report the students whose department does not exist. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inner join removes exactly the rows you need.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd.id = NULL', 'next' => 'wrong_b'],
                ['label' => 'd.id IS NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. = NULL is never true.\nStep back to when you compared with =.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "NOT IN alternative risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'NULLs in the subquery', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One NULL makes NOT IN match nothing.\nStep back to when you ignored NULLs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, departments 1 and 7, students in 1, 7, 14 → the student in 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
