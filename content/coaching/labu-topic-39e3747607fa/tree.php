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
            'message' => "State:\nfirst skill on binary trees\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Traverse (DFS/BFS)', 'next' => 'mid'],
                ['label' => 'AVL rotations first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nWalk the tree before balancing it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nheight of a node\n\nNatural style?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse on left/right', 'next' => 'final'],
                ['label' => 'Only BFS can compute height', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDFS height is classic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nafter traversals\n\nNext specialization?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BST / heap rules', 'next' => 'success'],
                ['label' => 'Skip to network flow', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nBST/heap build on binary trees.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Traverse → recurse → specialize\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
