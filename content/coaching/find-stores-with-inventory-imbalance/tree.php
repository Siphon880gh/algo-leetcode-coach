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
            'message' => "Read the problem statement above.\nMinimum products per store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Corner Shop 2.50 and Plaza Store 1.50 are added.\nStep back to when you dropped the rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ratio ascending', 'next' => 'wrong_b'],
                ['label' => 'Ratio descending, then store name', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Downtown Tech 10.00 comes first instead of City Center 40.00.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → City Center 40.00, Suburb Mall 25.00, Downtown Tech 10.00.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
