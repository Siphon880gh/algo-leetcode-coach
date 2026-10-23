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
            'message' => "State:\nhead → [10] → [20] → [30] → null\naction = insert 15 after the head node\n\nCost if you already hold head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) — rewire head.next and the new node', 'next' => 'find'],
                ['label' => 'O(n) — every insert rewrites the whole list', 'next' => 'w_n'],
            ],
        ],
        'w_n' => [
            'message' => "Wrong.\n\nA local splice only updates a few pointers when you already hold the neighbor.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'find' => [
            'message' => "State:\nsame list\nneed = node with value 30\n\nCost from head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — walk until the value matches', 'next' => 'idx'],
                ['label' => 'O(1) — hash the value like an array index', 'next' => 'w_hash'],
            ],
        ],
        'w_hash' => [
            'message' => "Wrong.\n\nA plain linked list has no value→node index. You walk.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'find',
            'choices' => [],
        ],
        'idx' => [
            'message' => "State:\nclaim = \"get index 2 is O(1) like an array\"\n\nTrue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False — no contiguous address formula; walk 2 steps', 'next' => 'success'],
                ['label' => 'True — node.i is stored for every index', 'next' => 'w_idx'],
            ],
        ],
        'w_idx' => [
            'message' => "Wrong.\n\nLists do not give array-style random access unless you add extra structure.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'idx',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Splice at a known node: O(1)\n- Search / k-th node: O(n)\n- No free `a[i]`\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
