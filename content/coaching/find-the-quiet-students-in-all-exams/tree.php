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
            'message' => "Problem: A student table names students, and an exam table records each student's score per exam. Report students who took at least one exam and never had the highest or lowest score in any exam, ordered as the statement specifies. For instance, a student always strictly between each exam's top and bottom is quiet; one who tied the top once is not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTies at the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK (ties all count)', 'next' => 's2'],
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ROW_NUMBER marks only one of the tied students.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Students with no exams?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include them', 'next' => 'wrong_b'],
                ['label' => 'Exclude them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Quiet students must have taken an exam.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loud in one exam only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exclude them', 'next' => 'success'],
                ['label' => 'Include them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any exam where they are an extreme disqualifies them.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Exam takers minus anyone ranked first by DESC or ASC in any exam.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
