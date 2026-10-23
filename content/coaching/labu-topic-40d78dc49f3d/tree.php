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
            'message' => "State:\npops should return newest first\n\nADT?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stack', 'next' => 'mid'],
                ['label' => 'Queue', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nNewest-first is LIFO/stack.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nBFS neighbors\n\nADT?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue', 'next' => 'final'],
                ['label' => 'Stack', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBFS is FIFO.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsequence pushed 1,2,3 on a stack\n\nPop order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3,2,1', 'next' => 'success'],
                ['label' => '1,2,3', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLIFO reverses.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Newest→stack; oldest→queue\n- Match ADT to the order you need\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
