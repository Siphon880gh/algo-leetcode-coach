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
            'message' => "Read the problem statement above.\nGroup keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'date_id and make_name', 'next' => 's2'],
                ['label' => 'make_name only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The report is per day and make.\nStep back to when you dropped date_id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(…)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT …)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated ids would be counted again.\nStep back to when you dropped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Column names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'unique_leads, unique_partners', 'next' => 'success'],
                ['label' => 'leads, partners', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement fixes the names.\nStep back to when you renamed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example: 2020-12-8 toyota → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
