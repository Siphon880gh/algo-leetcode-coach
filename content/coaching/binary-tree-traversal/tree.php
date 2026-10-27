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
            'message' => "State:\nroot 1, with left child 2 and right child 3\n2 has left child 4\n\nIn what order does preorder visit the nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 4, 3', 'next' => 'bfs'],
                ['label' => '4, 2, 1, 3, which is inorder', 'next' => 'w_in'],
            ],
        ],
        'w_in' => [
            'message' => "Wrong.\n\nPreorder visits a node before its children: 1 first, then the left subtree, then the right subtree.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\nyou need level order\n\nWhich structure does it use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue, as in breadth-first search', 'next' => 'bst'],
                ['label' => 'Only a stack, which always gives the same order as preorder', 'next' => 'w_stack'],
            ],
        ],
        'w_stack' => [
            'message' => "Wrong.\n\nLevel order is breadth-first search, which takes nodes from a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'bst' => [
            'message' => "State:\nan inorder walk on a binary tree that is not a search tree\n\nAre the keys guaranteed to come out sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Sorted inorder needs the search-tree ordering rule.', 'next' => 'success'],
                ['label' => 'Yes. Inorder always means sorted.', 'next' => 'w_sort'],
            ],
        ],
        'w_sort' => [
            'message' => "Wrong.\n\nInorder is just a visiting order. Only the search-tree rule makes it sorted.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Preorder, inorder and postorder differ in where the visit happens in the recursion.\n- Level order uses a queue.\n- Sorted inorder needs a binary search tree.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
