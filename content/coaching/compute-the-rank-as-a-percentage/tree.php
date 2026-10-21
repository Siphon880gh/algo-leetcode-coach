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
            'message' => "Problem: A table Students records student_id, department_id and mark. For each student, report their percentage within their department, computed as the statement defines from the student’s rank (marks from highest to lowest, tied marks sharing a rank) and the size of the department, rounded as the statement specifies. A student alone in a department needs the special case the statement gives. For instance, in a department with marks 920, 610 and 530 the ranks are 1, 2 and 3 out of 3. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRanking function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK()', 'next' => 's2'],
                ['label' => 'ROW_NUMBER()', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Tied students 2 and 8 get ranks 1 and 2 instead of both 1.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rank within?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole table', 'next' => 'wrong_b'],
                ['label' => 'PARTITION BY department_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Student 1 gets rank 4 instead of 2 in the constructed table.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Department size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) OVER (PARTITION BY department_id)', 'next' => 'success'],
                ['label' => 'COUNT(*) over the whole table', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Student 5, alone in department 3, gets size 6 instead of 1.\nStep back to when you counted the whole table.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed rank and size check matches; then apply the statement’s formula.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
