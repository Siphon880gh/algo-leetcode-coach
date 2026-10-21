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
            'message' => "Problem: BST with 0 to 2000 unique values. Convert it in place to a sorted circular doubly linked list: left becomes prev, right becomes next. Return the smallest node. [4,2,5,1,3] → 1↔2↔3↔4↔5, with 5 linked back to 1. Empty → null. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inorder walk (left, node, right) visits values in sorted order', 'next' => 's2'],
                ['label' => 'Level order or preorder, then link nodes as you see them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Preorder and level order do not visit a BST in sorted order. [4,2,5,1,3] in level order is 4, 2, 5, 1, 3.\nStep back to when you chose the traversal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep prev and head while you walk.\nWhat do you do when you visit a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allocate a new list node with the same value and append it', 'next' => 'wrong_b'],
                ['label' => 'If prev exists: prev.right = node, node.left = prev. Else head = node. Then prev = node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The task says in place: reuse the tree nodes, do not allocate new ones.\nStep back to when you created new nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the walk, prev is the largest. Close the circle: prev.right = head, head.left = prev. O(n) time, O(h) recursion. Flatten Binary Tree to Linked List (114) builds a preorder right spine, not this.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inorder stitch, then link last ↔ first. Not 114', 'next' => 'success'],
                ['label' => 'Leave head.left and tail.right as null', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The list must be circular: the smallest node's prev is the largest, and the largest's next is the smallest.\nStep back to when you left the ends open.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Inorder stitch with prev and head, then close the circle. [4,2,5,1,3] → 1↔2↔3↔4↔5↔1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
