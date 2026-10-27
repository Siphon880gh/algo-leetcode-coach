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
            'message' => "State:\ngraph stored as adjacency lists\naction: add a directed edge from B to C\n\nWhat does this usually cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) amortized, to append C to B\'s list', 'next' => 'mid'],
                ['label' => 'O(V²), to rebuild a matrix', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nWith lists you only append to one list. There is no matrix to rebuild.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou need to answer \"is there an edge from A to C?\" in O(1)\n\nWhich storage is better for that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An adjacency matrix, reading M[A][C]', 'next' => 'final'],
                ['label' => 'Adjacency lists, which always answer that in O(1)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nWith lists you have to scan A's neighbors, which takes O(degree of A).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ndelete vertex A from a graph stored as adjacency lists\n\nBesides deleting A's own list, what else must you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove A from every other vertex\'s neighbor list', 'next' => 'success'],
                ['label' => 'Nothing. Leftover references to A are fine.', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nOther lists would still point at a vertex that no longer exists.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Know what lists and matrices cost for each operation.\n- When you delete, keep both ends of every edge consistent.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
