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
            'message' => "Problem: An enrollments table gives each student's grade in each course. For each student, report the course with their highest grade and that grade, choosing the smallest course id on a tie, ordered by student id. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGROUP BY student with MAX(grade) and a bare course_id?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the course may not match the grade', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A non-aggregated column can come from any row.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order inside each student?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'grade DESC only', 'next' => 'wrong_b'],
                ['label' => 'grade DESC, course_id ASC', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties need the smallest course.\nStep back to when you skipped the tie-break.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "ROW_NUMBER or RANK?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER', 'next' => 'success'],
                ['label' => 'RANK', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With the tie-break, exactly one row per student is wanted.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). One row per student with the best grade and its course.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
