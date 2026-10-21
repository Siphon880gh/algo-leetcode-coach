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
            'message' => "Read the problem statement above.\nFor each node, what do you look for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether k − node.val has been seen before', 'next' => 's2'],
                ['label' => 'Whether k − node.val exists, searched in the BST', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works, but it is O(n · h) and must avoid matching the node with itself; a set is simpler and O(n).\nStep back to when you searched the BST.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you add node.val to the set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before checking', 'next' => 'wrong_b'],
                ['label' => 'After checking, so a node never pairs with itself', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With k = 2 · val, a single node would match itself.\nStep back to when you added before checking.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must the traversal be in order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any order works with a set', 'next' => 'success'],
                ['label' => 'Yes: it must be inorder', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Inorder plus two pointers is another method; the set does not need any order.\nStep back to when you required inorder.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DFS with a seen set: O(n) time, O(n) space. [5,3,6,2,4,null,7], k = 9 → true; k = 28 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
