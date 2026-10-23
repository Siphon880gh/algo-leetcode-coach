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
            'message' => "State:\nroot=1, left=2, right=3, and 2.left=4\n\nIs 4 a leaf?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes — both children empty', 'next' => 'bin'],
                ['label' => 'No — leaves must be right children only', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nA leaf is any node with no children, left or right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bin' => [
            'message' => "State:\na node shows three child pointers\n\nStill a binary tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — binary means at most left and right', 'next' => 'visit'],
                ['label' => 'Yes — binary only means "has a root"', 'next' => 'w_bin'],
            ],
        ],
        'w_bin' => [
            'message' => "Wrong.\n\nBinary = ≤2 children with left/right roles.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bin',
            'choices' => [],
        ],
        'visit' => [
            'message' => "State:\nn nodes, walk each once\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(1) — trees are always constant size', 'next' => 'w_o1'],
            ],
        ],
        'w_o1' => [
            'message' => "Wrong.\n\nVisiting every node scales with n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'visit',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- ≤2 children per node\n- Leaves have empty left and right\n- Full walk is O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
