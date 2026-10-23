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
            'message' => "State:\ninsert 1,2,3 into empty AVL\nafter inserting 3 the chain is right-right\n\nFix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left rotate around 1 → root 2 with children 1 and 3', 'next' => 'bf'],
                ['label' => 'Do nothing — BST shape is enough', 'next' => 'w_skip'],
            ],
        ],
        'w_skip' => [
            'message' => "Wrong.\n\nAVL must rotate when |balance factor| > 1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bf' => [
            'message' => "State:\nbalance factor definition (height left − height right), typical\n\nAllowed range after fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1, 0, or +1 at every node', 'next' => 'cost'],
                ['label' => 'Any integer — AVL only cares about BST order', 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nThe height invariant is what makes AVL logarithmic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bf',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nn keys in an AVL\n\nSearch time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log n) worst case', 'next' => 'success'],
                ['label' => 'O(n) worst case like a skewed BST', 'next' => 'w_n'],
            ],
        ],
        'w_n' => [
            'message' => "Wrong.\n\nRotations prevent the skew that makes plain BSTs O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- BST + height balance via rotations\n- O(log n) ops\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
