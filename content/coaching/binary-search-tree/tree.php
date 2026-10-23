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
            'message' => "State:\nBST root=4, left=2, right=6, 2.left=1, 2.right=3\nsearch key = 3\n\nFirst step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go left of 4 because 3 < 4', 'next' => 'inorder'],
                ['label' => 'Go right of 4 because searches always go right first', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nCompare with the node and follow the BST rule.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'inorder' => [
            'message' => "State:\ninorder traversal of this BST\n\nSequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 3, 4, 6', 'next' => 'skew'],
                ['label' => '4, 2, 1, 3, 6 — preorder', 'next' => 'w_pre'],
            ],
        ],
        'w_pre' => [
            'message' => "Wrong.\n\nInorder on a BST lists keys ascending.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'inorder',
            'choices' => [],
        ],
        'skew' => [
            'message' => "State:\ninsert 1,2,3,4,5 in order into an empty unbalanced BST\n\nSearch cost risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — tree skews into a chain', 'next' => 'success'],
                ['label' => 'Still O(log n) — BST always balances itself', 'next' => 'w_bal'],
            ],
        ],
        'w_bal' => [
            'message' => "Wrong.\n\nPlain BSTs do not rotate. Sorted inserts skew.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'skew',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Left < node < right\n- Ops O(h); balance matters\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
