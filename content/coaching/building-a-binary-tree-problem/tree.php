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
            'message' => "State:\npreorder starts with 3; inorder [9,3,15,20,7]\n\nLeft subtree inorder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[9]', 'next' => 'mid'],
                ['label' => '[15,20,7]', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nValues left of 3 in inorder form the left tree.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nonly preorder given, values unique, arbitrary shapes\n\nUnique rebuild?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always — need inorder (or equivalent) too', 'next' => 'final'],
                ['label' => 'Always unique from preorder alone', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreorder alone does not fix left/right sizes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nhash inorder value→index\n\nBuild time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²) required to scan inorder each time', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe hash removes repeated scans.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Preorder root + inorder split\n- Recurse on ranges\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
