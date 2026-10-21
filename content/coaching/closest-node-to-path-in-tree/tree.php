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
            'message' => "Problem: You are given a tree of n nodes numbered 0 … n − 1 as a list of edges, and queries [start, end, node]. For each query, return the node on the path from start to end that is closest to node. For instance, n = 7, edges [[0,1],[0,2],[0,3],[1,4],[2,5],[2,6]], queries [[5,3,4],[5,3,6]] → [0,2]; n = 3, edges [[0,1],[1,2]], query [[0,1,2]] → [1]. (Restated from memory; limits and examples may differ slightly.)\nCandidate meeting points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lca(s, e), lca(s, v), lca(e, v)', 'next' => 's2'],
                ['label' => 'Only lca(s, e)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Query [5,3,6] in the first case → 0 instead of 2.\nStep back to when you used one LCA.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which of the three?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The shallowest', 'next' => 'wrong_b'],
                ['label' => 'The deepest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Query [5,3,6] → 0 instead of 2; the shallowest is just the top of the path.\nStep back to when you took the shallowest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "LCA for many queries?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary lifting', 'next' => 'success'],
                ['label' => 'Walk up one parent at a time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. On a long chain each query walks the whole tree, too slow for many queries.\nStep back to when you walked parent by parent.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Constructed cases → [0,2], [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
