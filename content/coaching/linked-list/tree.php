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
            'message' => "State:\nthe list is head, then 10, 20, 30, then null\ntask: insert 15 after the head node\n\nWhat does it cost if you already hold head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1), by rewiring head.next and the new node', 'next' => 'find'],
                ['label' => 'O(n), because every insert rewrites the whole list', 'next' => 'w_n'],
            ],
        ],
        'w_n' => [
            'message' => "Wrong.\n\nA local splice updates only a few pointers when you already hold the neighbor.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'find' => [
            'message' => "State:\nthe same list\nyou need the node with value 30\n\nWhat does it cost, starting from head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), walking until the value matches', 'next' => 'idx'],
                ['label' => 'O(1), hashing the value like an array index', 'next' => 'w_hash'],
            ],
        ],
        'w_hash' => [
            'message' => "Wrong.\n\nA plain linked list has no index from values to nodes. You have to walk.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'find',
            'choices' => [],
        ],
        'idx' => [
            'message' => "State:\nsomeone claims that getting index 2 is O(1), as in an array\n\nIs that true?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False. There is no address formula, so you walk 2 steps.', 'next' => 'success'],
                ['label' => 'True. Every node stores its index.', 'next' => 'w_idx'],
            ],
        ],
        'w_idx' => [
            'message' => "Wrong.\n\nLists do not offer array-style random access unless you add an extra structure.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'idx',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A splice at a known node is O(1).\n- A search, or finding the k-th node, is O(n).\n- There is no free `a[i]`.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
