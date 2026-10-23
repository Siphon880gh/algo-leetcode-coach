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
            'message' => "Problem: You get a tree with n nodes (given as an edge list, rooted at node 0) and a group label for every node. Two nodes are in the same group when their labels match, and the cost of a pair is the number of edges between them. Return the total cost over all unordered pairs in the same group. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Edge contributions', 'next' => 's2'],
                ['label' => 'Depth differences per pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): n = 5, edges [[0, 1], [0, 2], [1, 3], [2, 4]], group = [1, 2, 2, 1, 1] → 4 instead of 10.\nStep back to when you ignored the LCA.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge above v adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ c · total', 'next' => 'wrong_b'],
                ['label' => 'Σ c · (total − c)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same check → 16 instead of 10.\nStep back to when you used the full total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 10, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
