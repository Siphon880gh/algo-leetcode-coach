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
            'message' => "Problem: A flights table gives each flight’s capacity, and a passengers table records which flight each passenger booked. For each flight, report how many booked passengers get a seat and how many are on the waitlist, ordered as the statement says. The exact columns and output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin flights to passengers with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Flights with no bookings vanish; in SQLite the check loses flight 3.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Waitlisted equals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count − capacity', 'next' => 'wrong_b'],
                ['label' => 'MAX(count − capacity, 0)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Spare seats go negative; in SQLite flight 2 → −1 instead of 0.\nStep back to when you dropped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → (2, 1), (1, 0), (0, 0).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
