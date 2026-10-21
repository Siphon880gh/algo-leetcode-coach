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
            'message' => "Problem: A connected undirected graph has n nodes and n edges, so it contains exactly one cycle. Return an array where entry i is the minimum number of edges from node i to any node on the cycle. For instance, n = 7 with edges [[1,2],[2,4],[4,3],[3,1],[0,1],[5,2],[6,5]] → [1,0,0,0,0,1,2]; a triangle → [0,0,0]. (Restated from memory; limits and examples may differ slightly.)\nFind the cycle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Peel degree-1 nodes until none are left', 'next' => 's2'],
                ['label' => 'BFS from node 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A plain BFS does not tell which nodes lie on the cycle.\nStep back to when you started a BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distances?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A BFS from every node', 'next' => 'wrong_b'],
                ['label' => 'One BFS from all cycle nodes at once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²) and repeats work for every node.\nStep back to when you ran n searches.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which nodes are on the cycle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those never peeled', 'next' => 'success'],
                ['label' => 'Those with degree 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In the constructed example node 5 has degree 2 but is distance 1 from the cycle.\nStep back to when you used degree 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → [1,0,0,0,0,1,2], [0,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
