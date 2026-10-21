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
            'message' => "Problem: each node has left, right, parent. Given a node (no root), return the node with the smallest key greater than it, or null. [2,1,3], node 1 → 2. [5,3,6,2,4,null,null,1], node 6 → null. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two cases: right subtree exists or not', 'next' => 's2'],
                ['label' => 'Return node.parent', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The parent is not always larger. A right child's parent is smaller.\nStep back to when you returned the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "node has a right child.\nWhere is the successor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'node.right itself', 'next' => 'wrong_b'],
                ['label' => 'node.right, then follow left to the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right child is larger, but its left subtree holds smaller values that are still larger than node.\nStep back to when you returned node.right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No right child: climb while node == node.parent.right, then return node.parent. O(h).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leftmost of right, else climb past right-child links. Not 285', 'next' => 'success'],
                ['label' => 'Climb one parent and return it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Climbing just once misses chains: a right child of a right child must keep going.\nStep back to when you climbed once.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Leftmost of the right subtree, or climb until coming from the left. Node 6 → null.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
