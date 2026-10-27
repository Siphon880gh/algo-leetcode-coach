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
            'message' => "State:\na = [10, 20, 30]\nneed a[2]\n\nHow much does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'mid'],
                ['label' => 'O(n), to walk to it', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nArrays jump straight to any index in O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ninsert 5 at index 0 of the array\n\nHow much does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because every element shifts right', 'next' => 'final'],
                ['label' => 'O(1), because arrays never shift', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nInserting at the front moves every element one slot right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninsert 5 at the head of a linked list\n\nHow much does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1), using the head pointer', 'next' => 'success'],
                ['label' => 'O(n), always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe new node points at the old head and becomes the head. Nothing else moves.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Array reads are fast, but inserting at the front or middle of an array shifts elements.\n- Inserting at the head of a linked list is cheap.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
