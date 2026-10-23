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
            'message' => "State:\nroot=1,left=2,right=3\npreorder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1,2,3', 'next' => 'mid'],
                ['label' => '2,1,3', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPreorder visits root first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nsame tree inorder?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2,1,3', 'next' => 'final'],
                ['label' => '1,2,3', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nInorder is left, root, right.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninorder on a non-BST\n\nSorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not guaranteed', 'next' => 'success'],
                ['label' => 'Always sorted', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nNeed BST property for sorted inorder.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Move the visit slot\n- O(n) walks\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
