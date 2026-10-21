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
            'message' => "Read the problem statement above.\nWhat is the matrix, really?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An adjacency matrix: count connected components', 'next' => 's2'],
                ['label' => 'A grid: count islands of 1s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Cell (i, j) is an edge between cities i and j, not a land square. Flood-filling grid neighbors mixes unrelated cities.\nStep back to when you read the matrix as a grid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Components it is. How do you count them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count the 1s above the diagonal', 'next' => 'wrong_b'],
                ['label' => 'For each unvisited city: count 1, then DFS along its row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edges are not provinces: the chain 0–1–2 has two edges but one province.\nStep back to when you counted edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DFS is O(n²). Union-find is the other route. How does it count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start at n; every union of two different roots subtracts 1', 'next' => 'success'],
                ['label' => 'Count distinct parent[i] values without calling find', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. parent[i] can point at a non-root, so one province shows several values unless you find() each root.\nStep back to when you read parent[] raw.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Components of the adjacency matrix by DFS or union-find: O(n²) time, O(n) space. [[1,1,0],[1,1,0],[0,0,1]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
