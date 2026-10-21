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
            'message' => "Problem: A buses table lists each bus id and its arrival time, and a passengers table lists each passenger id and arrival time. A passenger boards the first bus that arrives at or after the passenger's arrival, as the statement defines. Report how many passengers board each bus. For instance, buses 1, 2, 3 arriving at 2, 4, 7 and passengers arriving at 1, 5, 6, 7 → bus 1 carries 1, bus 2 carries 0, bus 3 carries 3. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich bus for a passenger?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MIN bus time ≥ passenger time', 'next' => 's2'],
                ['label' => 'MAX bus time ≤ passenger time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That bus left before the passenger arrived.\nStep back to when you took the previous bus.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Buses nobody boarded?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inner join with the assignments', 'next' => 'wrong_b'],
                ['label' => 'LEFT JOIN from buses so they show 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bus 2 in the constructed example disappears instead of showing 0.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(passenger_id)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An empty bus still has one joined row, so COUNT(*) gives 1 for bus 2.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → (1, 1), (2, 0), (3, 3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
