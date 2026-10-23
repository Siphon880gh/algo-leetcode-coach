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
            'message' => "State:\ntree root=1, left=2, right=3, 2.left=4\n\nPreorder visit sequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 4, 3', 'next' => 'bfs'],
                ['label' => '4, 2, 1, 3 — that is inorder', 'next' => 'w_in'],
            ],
        ],
        'w_in' => [
            'message' => "Wrong.\n\nPreorder visits root before children: 1 then left subtree then right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\nlevel-order needed\n\nStructure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue — BFS', 'next' => 'bst'],
                ['label' => 'Stack only — same as preorder always', 'next' => 'w_stack'],
            ],
        ],
        'w_stack' => [
            'message' => "Wrong.\n\nLevel-order is BFS with a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'bst' => [
            'message' => "State:\ninorder on a non-BST binary tree\n\nSorted keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not guaranteed — sorted inorder needs the BST invariant', 'next' => 'success'],
                ['label' => 'Always sorted — inorder means sorted', 'next' => 'w_sort'],
            ],
        ],
        'w_sort' => [
            'message' => "Wrong.\n\nInorder is a visit order; BST adds the value invariant.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pre/in/post = DFS visit slots\n- Level-order = queue BFS\n- Sorted inorder ⇒ needs BST\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
