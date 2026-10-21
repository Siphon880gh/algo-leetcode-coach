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
            'message' => "Problem: One table lists students with their department; another lists departments. Report every department's name with its number of students, including departments with none, ordered by that count descending and then by name. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich table do you start from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Department, LEFT JOIN Student', 'next' => 's2'],
                ['label' => 'Student JOIN Department', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Departments with no students vanish from that join.\nStep back to when you started from Student.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(s.student_id)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. COUNT(*) counts the null row an empty department gets, so it reports 1 instead of 0.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is the result ordered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'student_number DESC, then dept_name ASC', 'next' => 'success'],
                ['label' => 'dept_name only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The main key is the count, highest first; the name only breaks ties.\nStep back to when you sorted by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Department LEFT JOIN Student, COUNT(student_id), count then name: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
