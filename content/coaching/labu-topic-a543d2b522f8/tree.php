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
            'message' => "State:\nroot = 1, left = 2, right = 3\n\nWhat is the preorder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 3', 'next' => 'mid'],
                ['label' => '2, 1, 3', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPreorder visits the root first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe same tree\n\nWhat is the inorder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2, 1, 3', 'next' => 'final'],
                ['label' => '1, 2, 3', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nInorder goes left, then root, then right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninorder on a tree that is not a binary search tree\n\nIs the output sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not necessarily', 'next' => 'success'],
                ['label' => 'Always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nSorted inorder needs the binary search tree property.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Only the position of the visit line changes.\n- Each walk is O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
