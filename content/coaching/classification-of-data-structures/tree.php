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
            'message' => "State:\nneed FIFO ops\n\nADT name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue', 'next' => 'mid'],
                ['label' => 'Binary heap', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nFIFO is the queue ADT.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nqueue ADT\n\nValid layout?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ring buffer or linked head/tail — both can work', 'next' => 'final'],
                ['label' => 'Only a balanced BST can be a queue', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMany layouts implement FIFO.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\n“list” in conversation about O(1) index\n\nClarify?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array-backed vs linked — index costs differ', 'next' => 'success'],
                ['label' => 'No need — all lists have O(1) index', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLinked lists do not give O(1) index.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Separate ADT from layout\n- Pick layout for the hot op\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
