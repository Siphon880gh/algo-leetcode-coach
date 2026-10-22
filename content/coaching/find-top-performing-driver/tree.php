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
            'message' => "Problem: Three tables describe drivers (each with an accident count), vehicles (each with its driver and fuel type) and trips (each with its vehicle, distance and rating). For each fuel type, return the top-performing driver by average trip rating, rounded as the statement says, with ties broken as the statement specifies. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTies on rating go to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longer distance, then fewer accidents', 'next' => 's2'],
                ['label' => 'Fewer accidents', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check driver 2 wins fuel g instead of driver 1.\nStep back to when you skipped distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pick with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK by rating only', 'next' => 'wrong_b'],
                ['label' => 'ROW_NUMBER over the full order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both fuels return two drivers in the guide’s check (checked in SQLite).\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → (e, 3, 3.0), (g, 1, 4.5).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
