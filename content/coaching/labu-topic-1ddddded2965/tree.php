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
            'message' => "State:\nyou are reversing a linked list\nyou are about to change cur.next\n\nWhat must you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save nxt = cur.next', 'next' => 'mid'],
                ['label' => 'Set cur.next = prev right away, without saving anything', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nOnce cur.next changes, the rest of the list is unreachable. Save the forward link first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe operation might delete the head node\n\nWhat helper makes this easier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A dummy node placed before the head', 'next' => 'final'],
                ['label' => 'No helper. Handle every case by hand.', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA dummy node turns \"delete the head\" into an ordinary delete.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need the middle node of the list\n\nWhich technique fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fast and slow pointers', 'next' => 'success'],
                ['label' => 'First store every node\'s index in a hash map', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFast and slow pointers find the middle in one pass with O(1) extra space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Dummy head, fast and slow pointers, and saving next are the core tools.\n- Draw the pointers before rewiring them.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
