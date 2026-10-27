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
            'message' => "State:\nroot 1, with left child 2 and right child 3\n2 has left child 4\n\nIs 4 a leaf?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, because it has no children', 'next' => 'bin'],
                ['label' => 'No, because leaves must be right children', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nA leaf is any node with no children. It does not matter which side it hangs from.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bin' => [
            'message' => "State:\none node has three child pointers\n\nIs this still a binary tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Binary means at most a left child and a right child.', 'next' => 'visit'],
                ['label' => 'Yes. Binary only means the tree has a root.', 'next' => 'w_bin'],
            ],
        ],
        'w_bin' => [
            'message' => "Wrong.\n\nBinary means each node has at most two children, one on the left and one on the right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bin',
            'choices' => [],
        ],
        'visit' => [
            'message' => "State:\nthe tree has n nodes\nyou visit each node once\n\nHow long does that take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(1), because trees are always a constant size', 'next' => 'w_o1'],
            ],
        ],
        'w_o1' => [
            'message' => "Wrong.\n\nVisiting every node takes time that grows with the number of nodes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'visit',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Each node has at most two children.\n- A leaf has no left child and no right child.\n- Visiting every node is O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
