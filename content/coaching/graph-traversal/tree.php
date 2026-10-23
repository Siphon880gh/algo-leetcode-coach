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
            'message' => "State:\nedges A—B, A—C, B—D\nstart = A\nalgorithm = BFS\n\nStructure for neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue — FIFO level order', 'next' => 'mid'],
                ['label' => 'Stack only — that forces DFS shape', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBFS needs a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nundirected edge A—B\nvisited set forgotten\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Infinite A↔B bounce', 'next' => 'final'],
                ['label' => 'None — undirected graphs cannot cycle', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nUndirected edges are cycles of length 2 for traversal.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nV vertices, E edges, adj lists\n\nTime to traverse all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(V+E)', 'next' => 'success'],
                ['label' => 'O(V²) always, even when sparse', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAdj-list traversal is linear in vertices+edges.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- BFS queue / DFS stack\n- Visited set required\n- O(V+E)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
