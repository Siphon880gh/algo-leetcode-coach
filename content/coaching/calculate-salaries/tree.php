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
            'message' => "Problem: A salaries table lists employees by company. Each company's tax rate depends on its maximum salary (thresholds as the statement specifies); report each salary after tax, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRate based on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Company maximum', 'next' => 's2'],
                ['label' => 'Each employee\'s salary', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement sets one rate per company.\nStep back to when you used the row's salary.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Threshold edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Guess', 'next' => 'wrong_b'],
                ['label' => 'Exactly as stated (inclusive or exclusive)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Off-by-one at the boundary changes the rate.\nStep back to when you guessed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As specified, after applying the rate', 'next' => 'success'],
                ['label' => 'Truncate', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Truncation differs from rounding.\nStep back to when you truncated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Window MAX per company, CASE for the rate, ROUND on the result.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
