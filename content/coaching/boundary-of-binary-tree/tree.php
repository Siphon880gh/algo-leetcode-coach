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
            'message' => "Problem: up to 1e4 nodes. Return root, left boundary, leaves, then right boundary reversed. [1,null,2,3,4] → [1,3,4,2]. [1,2,3,4,5,6,null,null,null,7,8,9,10] → [1,2,4,7,8,9,10,6,3]. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three walks: left edge, leaves, right edge', 'next' => 's2'],
                ['label' => 'Take the first and last node of each level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A level-order outline is not the boundary; it misses inner leaves and includes wrong nodes.\nStep back to when you used level order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking the left boundary.\nWhere next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'node.right first, else node.left', 'next' => 'wrong_b'],
                ['label' => 'node.left if it exists, else node.right; stop at a leaf', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If a left child exists, the boundary must use it.\nStep back to when you preferred the right child.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leaves by DFS left to right (skip the root). Right edge prefers right, else left, then reverse. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Edges without leaves, leaves once, right edge reversed', 'next' => 'success'],
                ['label' => 'Include the last leaf in both edges', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leaves are already in the leaf list. Adding them to the edges duplicates them.\nStep back to when you kept leaves in the edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Root, left edge, leaves, reversed right edge. → [1,3,4,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
