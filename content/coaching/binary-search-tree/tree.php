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
            'message' => "State:\nroot 4, with left child 2 and right child 6\n2 has left child 1 and right child 3\nsearch for 3\n\nWhat is the first step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go left from 4, because 3 is less than 4', 'next' => 'inorder'],
                ['label' => 'Go right from 4, because searches always go right first', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nCompare the key with the node: smaller goes left, larger goes right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'inorder' => [
            'message' => "State:\nsame tree\n\nWhat order does an inorder walk visit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 3, 4, 6', 'next' => 'skew'],
                ['label' => '4, 2, 1, 3, 6, which is preorder', 'next' => 'w_pre'],
            ],
        ],
        'w_pre' => [
            'message' => "Wrong.\n\nAn inorder walk of a binary search tree lists the keys in ascending order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'inorder',
            'choices' => [],
        ],
        'skew' => [
            'message' => "State:\ninsert 1, 2, 3, 4, 5 in that order into an empty tree that never rebalances\n\nWhat happens to search cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It becomes O(n), because the tree turns into a chain', 'next' => 'success'],
                ['label' => 'It stays O(log n), because a search tree always balances itself', 'next' => 'w_bal'],
            ],
        ],
        'w_bal' => [
            'message' => "Wrong.\n\nA plain search tree never rotates, so sorted inserts make every new key a right child.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'skew',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Left subtree keys are smaller than the node, right subtree keys are larger.\n- Operations cost O(h), so balance matters.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
