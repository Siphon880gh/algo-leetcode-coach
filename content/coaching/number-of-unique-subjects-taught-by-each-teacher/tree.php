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
            'message' => "Read the problem statement above.\nAggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT subject_id)', 'next' => 's2'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Subject 2 is taught in two departments; teacher 1 → 3 instead of 2.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'teacher_id and dept_id', 'next' => 'wrong_b'],
                ['label' => 'teacher_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Teacher 1 gets two rows, 2 and 1, instead of one row of 2.\nStep back to when you grouped by department too.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Distinct on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'subject_id', 'next' => 'success'],
                ['label' => 'dept_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Teacher 2 → 1 instead of 4.\nStep back to when you counted departments.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Example → (1, 2), (2, 4).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
