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
            'message' => "Problem: You get a connected undirected graph with positive edge weights. The cost of a path from node 0 to node n − 1 is its total weight without its heaviest edge (one copy only, if several tie). Return the smallest cost over all paths. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich edge is free?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any one edge, chosen by the search', 'next' => 's2'],
                ['label' => 'The heaviest edge of the shortest path', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): path 0–1–2–3 with weights 1, 1, 1 plus edge 0–3 of weight 20 → 2 instead of 0.\nStep back to when you fixed the path first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many free edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any number', 'next' => 'wrong_b'],
                ['label' => 'One: layer 1 never drops again', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): edges 0–1 (3), 1–2 (5) → 0 instead of 3.\nStep back to when you kept dropping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n). Constructed checks → 0, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
