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
            'message' => "State:\nundirected edges: A and B, A and C, B and D, C and D\nneed all neighbors of A\n\nWhat does the adjacency list say?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[B, C]', 'next' => 'sparse'],
                ['label' => '[B, C, D], because D is also next to A', 'next' => 'w_d'],
            ],
        ],
        'w_d' => [
            'message' => "Wrong.\n\nIn this drawing there is no edge directly between D and A.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'sparse' => [
            'message' => "State:\nV is huge and the number of edges E is about V (a sparse graph)\n\nWhich storage should you prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacency lists, because a matrix would need O(V²) memory', 'next' => 'dir'],
                ['label' => 'Always a matrix, because lists cannot store undirected edges', 'next' => 'w_mat'],
            ],
        ],
        'w_mat' => [
            'message' => "Wrong.\n\nLists store an undirected edge as one entry in each endpoint's list.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'sparse',
            'choices' => [],
        ],
        'dir' => [
            'message' => "State:\nthere is only a directed edge from A to B\n\nDoes A appear in B's list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, unless you also add an edge from B to A', 'next' => 'success'],
                ['label' => 'Yes, because lists ignore direction', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nThe direction decides which list gets the entry. A directed edge goes only in its source's list.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'dir',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Use lists for sparse graphs. Use a matrix for dense graphs or constant-time edge checks.\n- A directed edge is stored in its source's list.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
