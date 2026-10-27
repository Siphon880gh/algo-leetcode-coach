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
            'message' => "State:\nremovals should return the newest item first\n\nWhich structure fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stack', 'next' => 'mid'],
                ['label' => 'Queue', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nNewest first is LIFO, which is a stack.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou are visiting neighbors in BFS\n\nWhich structure fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue', 'next' => 'final'],
                ['label' => 'Stack', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBFS needs FIFO order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\n1, 2 and 3 were pushed onto a stack in that order\n\nWhat order do they pop in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, 2, 1', 'next' => 'success'],
                ['label' => '1, 2, 3', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA stack is LIFO, so it reverses the order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Newest first means a stack.\n- Oldest first means a queue.\n- Match the structure to the order you need.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
