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
            'message' => "Problem: You get a connected undirected graph with weighted edges, a source s, a destination d and an integer k. You may treat up to k edges as having weight 0. Return the length of the shortest path from s to d. The exact limits are in the official statement. For instance, with edges 0–1 of weight 4, 1–2 of weight 5, 0–3 of weight 10 and 3–2 of weight 1, from 0 to 2: k = 0 → 9, k = 1 → 1, k = 2 → 0. (Restated from memory; limits and examples may differ slightly.)\nState for Dijkstra?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(node, free edges used so far)', 'next' => 's2'],
                ['label' => 'Node only, then zero the k heaviest edges of the plain shortest path', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A longer path can hold a heavier edge; with k = 1 → 4 instead of 1.\nStep back to when you fixed the path first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An edge from layer j < k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always take it free', 'next' => 'wrong_b'],
                ['label' => 'Allow both: pay w in layer j, or 0 into layer j + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That spends free edges on the first, cheap ones; path 0–1 (1), 1–2 (100), k = 1 → 100 instead of 1.\nStep back to when you forced the free edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · E log(k · V)). The example → 9, 1, 0 for k = 0, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
