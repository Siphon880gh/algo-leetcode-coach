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
            'message' => "State:\ninsert 1, 2, 3 into an empty AVL tree\nafter inserting 3, the nodes form a chain leaning right twice\n\nHow do you fix it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rotate left around 1, so 2 becomes the root with children 1 and 3', 'next' => 'bf'],
                ['label' => 'Do nothing, because the search tree order is already correct', 'next' => 'w_skip'],
            ],
        ],
        'w_skip' => [
            'message' => "Wrong.\n\nAn AVL tree must rotate when a balance factor goes outside −1 to 1. Here the factor at 1 is −2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bf' => [
            'message' => "State:\nbalance factor = height of left subtree − height of right subtree\n\nWhich values are allowed after a fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1, 0 or +1, at every node', 'next' => 'cost'],
                ['label' => 'Any integer, because an AVL tree only cares about search order', 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nThe height rule is what keeps an AVL tree logarithmic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bf',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nan AVL tree holds n keys\n\nHow long does a search take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log n), even in the worst case', 'next' => 'success'],
                ['label' => 'O(n) in the worst case, like a lopsided search tree', 'next' => 'w_n'],
            ],
        ],
        'w_n' => [
            'message' => "Wrong.\n\nRotations prevent the lopsided shape that makes a plain search tree O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- An AVL tree is a search tree kept balanced by rotations.\n- Every operation is O(log n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
