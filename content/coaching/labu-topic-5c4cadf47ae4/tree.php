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
            'message' => "State:\na = [4, 5, 6]\nread index 1\n\nWhat does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'mid'],
                ['label' => 'O(n)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nReading by index is O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ninsert a value at index 1\n\nWhat does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because later elements shift', 'next' => 'final'],
                ['label' => 'O(1)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEverything after the insert position has to move.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou expect many range sum queries\n\nWhat do you prepare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums', 'next' => 'success'],
                ['label' => 'Re-sort the array for every query', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPrefix sums answer each range quickly.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Reading by index is O(1).\n- Inserting in the middle is O(n).\n- Prefix sums answer range queries.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
