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
            'message' => "Problem: Problem: Given a BST and a value target, split it into two BSTs: nodes ≤ target and nodes > target, keeping the original parent-child links where possible. Return both roots. (Restated from memory; limits and examples may differ slightly.)\nnode.val ≤ target. Where does node go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Into the small tree, with its whole left subtree', 'next' => 's2'],
                ['label' => 'Into the large tree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Its value is ≤ target.\nStep back to when you put it in the large tree.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then what about node.right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep node.right as is', 'next' => 'wrong_b'],
                ['label' => 'Split it; attach its small part as node.right, and return its large part', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. node.right can contain values greater than target.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How much of the tree is touched?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the search path for target: O(h)', 'next' => 'success'],
                ['label' => 'Every node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Off-path subtrees move as whole units.\nStep back to when you visited every node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h). [4,2,6,1,3,5,7], target 2 → [[2,1],[4,3,6,null,null,5,7]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
