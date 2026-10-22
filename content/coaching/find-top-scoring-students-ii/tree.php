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
            'message' => "Problem: Tables list students and their major, courses with their major and whether each is mandatory or elective, and enrollments with a grade and a GPA. Return the students who meet the statement’s conditions on their major’s mandatory courses, their elective courses and their GPA. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMandatory courses test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No mandatory course lacks a top grade', 'next' => 's2'],
                ['label' => 'Count top grades anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check that also admits student 3.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the sets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union', 'next' => 'wrong_b'],
                ['label' => 'Intersect', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check that returns 1, 2, 3, 4 instead of 1.\nStep back to when you took the union.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
