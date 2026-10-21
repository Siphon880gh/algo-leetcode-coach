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
            'message' => "Read the problem statement above.\nWhat decides the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Source and destination share a component', 'next' => 's2'],
                ['label' => 'An edge joins them directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A path may use many edges; Example 1 connects 0 and 2 through 1.\nStep back to when you looked for a direct edge.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges are undirected. Adjacency?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only u → v', 'next' => 'wrong_b'],
                ['label' => 'Add both directions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path may walk an edge either way.\nStep back to when you stored one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Traversal with 2 · 10^5 nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterative BFS or union-find', 'next' => 'success'],
                ['label' => 'Plain recursive DFS', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A long chain can overflow the recursion stack.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E). Example 1 → true. Example 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
