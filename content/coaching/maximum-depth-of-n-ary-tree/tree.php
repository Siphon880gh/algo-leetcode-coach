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
            'message' => "Read the problem statement above.\nWhat is the depth of a node with several children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + the largest depth among its children', 'next' => 's2'],
                ['label' => '1 + the depth of its first child', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any child can hold the deepest branch, so you need the max over all of them.\nStep back to when you used one child.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What about an empty tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1 for null', 'next' => 'wrong_b'],
                ['label' => 'Return 0 for null; a leaf gets 1 + max of nothing = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An empty tree has depth 0: [] → 0.\nStep back to when you returned 1 for null.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Iterative alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS level by level and count the levels', 'next' => 'success'],
                ['label' => 'Count all the nodes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Node count is not depth: a root with 5 children has 6 nodes and depth 2.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 1 + max child depth, or BFS levels: O(n) time, O(h) or O(width) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
