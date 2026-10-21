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
            'message' => "Read the problem statement above.\nRemove each edge and test connectivity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one Tarjan DFS', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(E · (V + E)).\nStep back to when you removed edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visited neighbour (not the parent edge). Update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'low[u] = min(low[u], disc[v])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Back edges are what make cycles.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Bridge test for tree edge (u, v)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'low[v] > disc[u]', 'next' => 'success'],
                ['label' => 'low[v] ≥ disc[u]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equality means v reaches u another way.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V + E). n = 4, [[0,1],[1,2],[2,0],[1,3]] → [[1,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
