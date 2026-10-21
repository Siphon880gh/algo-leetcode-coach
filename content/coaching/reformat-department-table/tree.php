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
            'message' => "Read the problem statement above.\nOne row per what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Department id', 'next' => 's2'],
                ['label' => 'Department and month', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The months become columns.\nStep back to when you kept month rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Month missing for a department. Value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'NULL: no ELSE branch', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Missing revenue stays NULL.\nStep back to when you used ELSE 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why aggregate at all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY id needs an aggregate per column', 'next' => 'success'],
                ['label' => 'It is optional', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without it, the rows are not collapsed per id.\nStep back to when you dropped SUM.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Columns id, Jan_Revenue … Dec_Revenue.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
