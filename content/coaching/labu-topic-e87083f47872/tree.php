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
            'message' => "State:\njump game on [2, 3, 1, 1, 4]\n\nWhat do you keep track of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The farthest reachable index', 'next' => 'mid'],
                ['label' => 'The earliest interval end', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe jump game tracks how far you can reach.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nduring the scan, i is greater than farthest\n\nWhat does that mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You cannot reach the end', 'next' => 'final'],
                ['label' => 'It is still always possible', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nYou cannot even stand on index i, so the end is out of reach.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninterval scheduling\n\nWhat is the key for choosing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The earliest finishing time', 'next' => 'success'],
                ['label' => 'The farthest jump', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nInterval scheduling chooses by end time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match the clue to a greedy key.\n- The jump game tracks the farthest reachable index.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
