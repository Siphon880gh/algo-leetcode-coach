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
            'message' => "State:\nadj lists, add directed edge B→C\n\nTypical cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) amortized append to B’s list', 'next' => 'mid'],
                ['label' => 'O(V²) — must rebuild a matrix', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nLists append locally; no matrix rebuild.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nneed O(1) “is A→C an edge?”\n\nBetter store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adj matrix entry M[A][C]', 'next' => 'final'],
                ['label' => 'Adj list is always O(1) for that query', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nList query scans the neighbor list.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ndelete vertex A from adj-list graph\n\nMust you also…?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove A from other vertices’ neighbor lists', 'next' => 'success'],
                ['label' => 'Only delete A’s list — dangling refs are fine', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nOther lists would still mention A.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Know list vs matrix costs\n- Keep edge endpoints consistent on deletes\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
