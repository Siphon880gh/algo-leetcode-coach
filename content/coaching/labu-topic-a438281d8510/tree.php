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
            'message' => "State:\ncolor/state stack framework\n\nWhy re-push self?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'So a later state can visit after children', 'next' => 'mid'],
                ['label' => 'Never needed', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nIn/post visit after expanding children.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nwant preorder with colors\n\nWhen output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On first sight (before children handled)', 'next' => 'final'],
                ['label' => 'Only after both children', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreorder outputs early.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn nodes\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n log n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach node enters a constant number of states.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- (node,state) stack unifies orders\n- Output depends on state\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
