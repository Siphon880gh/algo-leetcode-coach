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
            'message' => "Read the problem statement above.\nStart from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Students CROSS JOIN Subjects', 'next' => 's2'],
                ['label' => 'Examinations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Students with no exams would vanish.\nStep back to when you started from Examinations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join Examinations on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'student_id only', 'next' => 'wrong_b'],
                ['label' => 'student_id and subject_name', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exams would count under every subject.\nStep back to when you joined on one key.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(e.student_id)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. COUNT(*) counts an unmatched row as 1.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Ordered by student_id and subject_name. Alice: Math 3, Physics 2, Programming 1. Alex: 0 for all three.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
