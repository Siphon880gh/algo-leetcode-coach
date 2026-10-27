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
            'message' => "State:\nthe root of a max-heap\n\nWhat does peek return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maximum', 'next' => 'mid'],
                ['label' => 'The minimum', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe root of a max-heap is the maximum.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou push a new value\n\nHow does it work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append it, then sift it up', 'next' => 'final'],
                ['label' => 'Overwrite a random leaf', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nAppend the value at the end, then sift it up.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need a priority queue\n\nWhat is the common implementation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A binary heap', 'next' => 'success'],
                ['label' => 'An unsorted array, always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA heap gives O(log n) updates.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A heap implements a priority queue.\n- Updates sift up or down.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
