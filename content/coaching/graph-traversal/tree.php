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
            'message' => "State:\nedges: A and B, A and C, B and D\nstart at A\nalgorithm: BFS\n\nWhich structure holds the neighbors waiting to be visited?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue, giving first in, first out level order', 'next' => 'mid'],
                ['label' => 'A stack, which would give a depth-first shape', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBreadth-first search needs a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nundirected edge between A and B\nyou forgot the visited set\n\nWhat goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The search bounces between A and B forever', 'next' => 'final'],
                ['label' => 'Nothing, because undirected graphs cannot have cycles', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDuring a traversal, every undirected edge acts like a two-step cycle.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nV vertices and E edges, stored as adjacency lists\n\nHow long does it take to traverse everything?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(V + E)', 'next' => 'success'],
                ['label' => 'O(V²), even when the graph is sparse', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nWith adjacency lists, a traversal is linear in vertices plus edges.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- BFS uses a queue and DFS uses a stack or recursion.\n- You need a visited set.\n- Both take O(V + E).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
