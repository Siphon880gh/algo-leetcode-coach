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
            'message' => "Problem: Using the same drivers, rides and accepted-ride tables as Hopper Company Queries I, report for every month of 2020 the percentage of available drivers who accepted at least one ride that month, rounded as the statement specifies, with 0 when no driver is available. For instance, 2 available drivers and 1 working driver in a month give 50. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWorking drivers count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT driver)', 'next' => 's2'],
                ['label' => 'COUNT(rides)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A driver with two rides is one working driver.\nStep back to when you counted rides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No available drivers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide anyway', 'next' => 'wrong_b'],
                ['label' => 'Report 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Division by zero gives NULL or an error.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ride month comes from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The ride request date in 2020', 'next' => 'success'],
                ['label' => 'The driver join date', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Join dates define availability, not work.\nStep back to when you used join dates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: 1 of 2 available drivers working → 50.00.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
