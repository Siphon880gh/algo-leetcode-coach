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
            'message' => "State:\nthe tree above\ncount edges from the root to node 4\n\nWhat is the depth of node 4?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'mid'],
                ['label' => '0', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThere are two edges on the path: 1 to 2, then 2 to 4.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou want to store a heap in an array\n\nWhich tree shape does that need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Complete: filled level by level, packed to the left', 'next' => 'final'],
                ['label' => 'Any sparse tree', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe array layout of a heap needs a complete tree.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nevery level is full, including the last one\n\nWhat is this shape called?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Perfect, which is stricter than complete', 'next' => 'success'],
                ['label' => 'Just "binary"', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\n\"Perfect\" is the word for a tree with every level full.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Fix your convention for depth and height.\n- Know the difference between complete and perfect.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
