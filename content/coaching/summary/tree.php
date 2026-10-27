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
            'message' => "State:\nthe most common operation is reading random indexes\n\nWhat do you prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An array or dynamic array', 'next' => 'mid'],
                ['label' => 'A singly linked list', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nA linked list makes index reads O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe most common operation is push_front\n\nWhat do you prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A linked list or a deque', 'next' => 'final'],
                ['label' => 'A dynamic array with no spare room at the front', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nInserting at the front of an array shifts every element.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe most common question is \"have I seen this key?\"\n\nWhat do you prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A hash set or map', 'next' => 'success'],
                ['label' => 'Scanning an unsorted array every time', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nHash membership is the upgrade.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match the structure to the most common operation.\n- Arrays, linked lists and hash tables each win in different cases.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
