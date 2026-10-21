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
            'message' => "Read the problem statement above.\nFULL OUTER JOIN in MySQL?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not available; union two anti-joins', 'next' => 's2'],
                ['label' => 'Use it directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. MySQL lacks FULL OUTER JOIN.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Only one direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Employees not in Salaries only', 'next' => 'wrong_b'],
                ['label' => 'Both directions needed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Missing names would be skipped.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY employee_id on the union', 'next' => 'success'],
                ['label' => 'No ordering', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement requires ascending ids.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
