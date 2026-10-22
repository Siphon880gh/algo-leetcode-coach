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
            'message' => "Problem: Tables list students and their major, courses and the major each belongs to, and enrollments with the grade a student got in a course. Return the students who took every course in their major and earned the top grade in each, as the statement defines it. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTest with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Double NOT EXISTS', 'next' => 's2'],
                ['label' => 'Count top grades ≥ major courses', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check that also admits student 2.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which courses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every course', 'next' => 'wrong_b'],
                ['label' => 'Only the student’s major', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check nobody qualifies instead of 1 and 3.\nStep back to when you used every course.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
