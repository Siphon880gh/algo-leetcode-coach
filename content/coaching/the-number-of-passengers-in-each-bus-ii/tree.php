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
            'message' => "Problem: A buses table lists each bus id, its arrival time and its capacity; a passengers table lists each passenger id and arrival time. When a bus arrives, waiting passengers (those who have arrived by then and not yet boarded) get on, up to the bus capacity; the rest keep waiting for later buses, following the boarding rule the statement gives. Report how many passengers board each bus. For instance, buses 1, 2, 3 arriving at 2, 4, 7 with capacities 1, 10, 2 and passengers arriving at 1, 1, 5, 6, 7 → buses carry 1, 1, 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nBus order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By arrival time', 'next' => 's2'],
                ['label' => 'By bus id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Who is waiting depends on which buses already left, which is a time order.\nStep back to when you used id order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Waiting passengers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arrived by then', 'next' => 'wrong_b'],
                ['label' => 'Arrived by then minus already boarded', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Passengers who boarded an earlier bus would be counted again.\nStep back to when you forgot the boarded total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(capacity, waiting)', 'next' => 'success'],
                ['label' => 'All waiting', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A bus cannot take more than its capacity.\nStep back to when you ignored capacity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass over buses in time order.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
