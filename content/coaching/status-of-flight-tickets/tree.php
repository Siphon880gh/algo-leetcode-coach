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
            'message' => "Problem: A flights table gives each flight’s capacity, and a passengers table records which flight each passenger booked and when. Seats go to the earliest bookings, up to the capacity; everyone else is waitlisted. Report each passenger’s status, ordered as the statement says. The exact columns, status labels and output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOrder each flight’s bookings by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Booking time', 'next' => 's2'],
                ['label' => 'Passenger id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Seats go to early bookers; in SQLite the check seats 10 instead of 12.\nStep back to when you ranked by id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number the rows over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All bookings together', 'next' => 'wrong_b'],
                ['label' => 'Each flight separately', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flights compete for one count; in SQLite passenger 13 → waitlisted instead of confirmed.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → 11, 12, 13 confirmed and 10 waitlisted.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
