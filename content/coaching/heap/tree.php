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
            'message' => "State:\nmax-heap [9, 5, 6, 2, 3]\n\nPeek maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '9 — root', 'next' => 'push'],
                ['label' => '3 — a leaf is always the max', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nIn a max-heap the root holds the maximum.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'push' => [
            'message' => "State:\npush 10 onto that heap\n\nMechanism?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append at end, then sift up', 'next' => 'del'],
                ['label' => 'Overwrite root immediately with 10', 'next' => 'w_root'],
            ],
        ],
        'w_root' => [
            'message' => "Wrong.\n\nThat breaks the heap. Append + sift up restores the order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'push',
            'choices' => [],
        ],
        'del' => [
            'message' => "State:\nneed to delete value 5 by value with no index map\n\nCheap O(log n) guaranteed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — plain heaps optimize the top, not arbitrary values', 'next' => 'success'],
                ['label' => 'Yes — heaps always delete any value in O(log n)', 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nWithout a handle you may scan O(n) to find 5 first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'del',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Peek O(1), push/pop O(log n)\n- Build O(n)\n- Arbitrary delete needs extra bookkeeping\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
