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
            'message' => "Problem: Given the root of a binary tree, count the nodes whose value equals the sum of all their descendants' values (a node with no descendants has sum 0). For instance, the tree [10,3,4,2,1] → 2 (node 10 = 3 + 4 + 2 + 1, node 3 = 2 + 1), [2,3,null,2] → 0, and [0] → 1. (Restated from memory; limits and examples may differ slightly.)\nTraversal order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Post-order: children first', 'next' => 's2'],
                ['label' => 'Pre-order: node first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The node needs its descendants' sums before it can compare.\nStep back to when you visited the node first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Descendant sum of a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left child value + right child value', 'next' => 'wrong_b'],
                ['label' => 'Left subtree total + right subtree total', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All descendants count, not just the children; node 10 needs 3 + 4 + 2 + 1.\nStep back to when you used child values only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A leaf with value 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts: its descendant sum is 0', 'next' => 'success'],
                ['label' => 'Never counts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No descendants means sum 0, which equals 0.\nStep back to when you skipped leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
