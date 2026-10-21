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
            'message' => "Problem: Given n cities and weighted connections [a, b, cost], return the minimum total cost to connect all cities, or −1 if it cannot be done. (Restated from memory; limits and examples may differ slightly.)\nProcess edges in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing cost', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Kruskal needs the cheapest edges first.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Endpoints already connected. Take the edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: skip it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It would form a cycle and only add cost.\nStep back to when you took it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Edges are done after fewer than n − 1 unions. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'The cost so far', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Some city is still unreachable.\nStep back to when you returned the cost.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log E). n = 3, [[1,2,5],[1,3,6],[2,3,1]] → 6. n = 4, [[1,2,3],[3,4,4]] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
