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
            'message' => "Problem: A table Rides records ride_id, driver_id and passenger_id. For every distinct driver id, return how many rides that same id took as a passenger, including 0. For instance, rides (7 drives 1), (7 drives 2), (11 drives 1), (11 drives 7) twice, (11 drives 3) → driver 7 was a passenger 2 times and driver 11 was a passenger 0 times. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDrivers who never rode?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN so they show 0', 'next' => 's2'],
                ['label' => 'Inner join', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Driver 11 disappears instead of showing 0.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(r.ride_id)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The NULL row makes driver 11 count 1.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Join condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r.passenger_id = d.driver_id', 'next' => 'success'],
                ['label' => 'r.driver_id = d.driver_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That counts rides driven; driver 11 → 4 instead of 0.\nStep back to when you joined on driver_id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → (7, 2), (11, 0).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
