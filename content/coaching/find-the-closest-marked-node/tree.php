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
            'message' => "Problem: You get a graph with n nodes and weighted edges, a source node and a list of marked nodes. Return the smallest distance from the source to any marked node, or −1 if no marked node can be reached. The edge format, whether edges are one-way, and the exact limits are in the official statement. For instance, with edges 0–1 of weight 1, 1–2 of weight 1 and 0–3 of weight 5, source 0 and marked nodes [2, 3], the answer is 2; with only an unreachable node marked, it is −1. (Restated from memory; limits and examples may differ slightly.)\nSearch with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra from the source', 'next' => 's2'],
                ['label' => 'BFS, stopping at the first marked node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Fewest edges is not least weight; the example → 5 (node 3) instead of 2 (node 2).\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No marked node is reachable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the infinity sentinel', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for −1 then; the second example → a huge number instead of −1.\nStep back to when you returned the sentinel.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log V). The examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
