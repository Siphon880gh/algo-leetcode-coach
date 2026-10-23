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
            'message' => "State:\nundirected A—B, A—C, B—D, C—D\nneed all neighbors of A\n\nAdj list answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[B, C]', 'next' => 'sparse'],
                ['label' => '[B, C, D] — D is also adjacent to A', 'next' => 'w_d'],
            ],
        ],
        'w_d' => [
            'message' => "Wrong.\n\nIn this drawing D is not directly edged to A.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'sparse' => [
            'message' => "State:\nV is huge, E ≈ V (sparse)\n\nPrefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adj list — matrix would be O(V²) memory', 'next' => 'dir'],
                ['label' => 'Adj matrix always — lists cannot represent undirected edges', 'next' => 'w_mat'],
            ],
        ],
        'w_mat' => [
            'message' => "Wrong.\n\nLists store undirected edges as two directed entries (or a careful undirected design).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'sparse',
            'choices' => [],
        ],
        'dir' => [
            'message' => "State:\ndirected edge A→B only\n\nIn B’s adj list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A does not appear unless you also added B→A', 'next' => 'success'],
                ['label' => 'A always appears — direction is ignored in lists', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nDirection is exactly which list gets the neighbor entry.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'dir',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Lists for sparse; matrix for dense / O(1) edge checks\n- Directed edges live on the source’s list\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
