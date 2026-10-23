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
            'message' => "Problem: You get an undirected graph with n nodes and weighted edges, where an edge’s weight is its repair cost, and every edge starts broken. You pick one budget, and every edge costing at most that budget gets repaired. Return the smallest budget that lets you travel from node 0 to node n − 1 using at most k edges, or −1 if none does. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSearch what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The budget, checking dist(n − 1) ≤ k', 'next' => 's2'],
                ['label' => 'The smallest bottleneck path, ignoring k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): the made-up graph with k = 1 → 2 instead of 9.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges usable at budget M?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cost < M', 'next' => 'wrong_b'],
                ['label' => 'Cost ≤ M', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): the same graph with k = 2 → 9 instead of 6.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). Constructed checks → 6, 9, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
