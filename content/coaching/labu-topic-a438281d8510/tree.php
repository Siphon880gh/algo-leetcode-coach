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
            'message' => "State:\nthe stack holds (node, state) pairs\n\nWhy push the node itself back onto the stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'So it can be visited later, after its children are expanded', 'next' => 'mid'],
                ['label' => 'It is never needed', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nInorder and postorder visit a node after expanding its children, so the node has to come back.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou want preorder with this framework\n\nWhen is a node output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As soon as it is first seen, before its children', 'next' => 'final'],
                ['label' => 'Only after both children', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreorder outputs the node early.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe tree has n nodes\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n log n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach node passes through a fixed number of states.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A stack of (node, state) pairs handles every order.\n- The output step depends on the state.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
