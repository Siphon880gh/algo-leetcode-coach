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
            'message' => "Read the problem statement above.\nSearch both subtrees?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the BST order says which side', 'next' => 's2'],
                ['label' => 'Yes, to be safe', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) and ignores the BST order.\nStep back to when you searched both sides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "val < node.val. Go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right', 'next' => 'wrong_b'],
                ['label' => 'Left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Smaller values live in the left subtree.\nStep back to when you went right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You find the value. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'That node, which is the root of the answer subtree', 'next' => 'success'],
                ['label' => 'A copy of the subtree', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The existing node already represents the subtree.\nStep back to when you copied.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h) time, O(1) iteratively. [4,2,7,1,3], val = 2 → [2,1,3]; val = 5 → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
