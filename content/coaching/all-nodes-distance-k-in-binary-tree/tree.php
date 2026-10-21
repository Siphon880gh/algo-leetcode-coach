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
            'message' => "Read the problem statement above.\nSearch only below the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: nodes at distance k can be above it or in another subtree', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Going up through the parent reaches nodes outside the target's subtree.\nStep back to when you searched only below.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you move upward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search from the root every time', 'next' => 'wrong_b'],
                ['label' => 'Record parent[node] with one DFS first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That repeats work for every step.\nStep back to when you re-searched from the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why keep a seen set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Without it, the BFS goes from a child to its parent and straight back', 'next' => 'success'],
                ['label' => 'It is not needed in a tree', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With parent links the tree is undirected, so you can walk back.\nStep back to when you dropped the seen set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). root = [3,5,1,6,2,0,8,null,null,7,4], target = 5, k = 2 → [7,4,1]. root = [1], target = 1, k = 3 → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
