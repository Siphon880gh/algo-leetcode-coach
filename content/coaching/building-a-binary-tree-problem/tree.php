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
            'message' => "State:\npreorder starts with 3\ninorder = [9, 3, 15, 20, 7]\n\nWhat is the inorder list of the left subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[9]', 'next' => 'mid'],
                ['label' => '[15, 20, 7]', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe values to the left of 3 in the inorder list form the left subtree. [15, 20, 7] is the right subtree.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nonly the preorder list is given\nall values are distinct\nthe tree could have any shape\n\nIs the tree always rebuilt uniquely?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always. You also need the inorder list or something equivalent.', 'next' => 'final'],
                ['label' => 'Yes. The preorder list alone always fixes the tree.', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreorder alone does not tell you how many nodes belong to each side.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\na hash map gives each value's index in the inorder list\n\nHow long does the rebuild take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²), because you must scan the inorder list every time', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe hash map finds the root in O(1), so there are no repeated scans.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Preorder gives the root, and inorder splits the left and right sides.\n- Recurse on the matching ranges.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
