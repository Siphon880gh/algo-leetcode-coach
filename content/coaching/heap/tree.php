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
            'message' => "State:\nmax-heap [9, 5, 6, 2, 3]\n\nWhat does peek return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '9, the root', 'next' => 'push'],
                ['label' => '3, because a leaf is always the maximum', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nIn a max-heap, the root holds the maximum.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'push' => [
            'message' => "State:\npush 10 onto that heap\n\nHow does the push work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 10 at the end, then sift it up', 'next' => 'del'],
                ['label' => 'Overwrite the root with 10 right away', 'next' => 'w_root'],
            ],
        ],
        'w_root' => [
            'message' => "Wrong.\n\nOverwriting the root loses 9 and breaks the heap. Appending and then sifting up restores the order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'push',
            'choices' => [],
        ],
        'del' => [
            'message' => "State:\nyou need to delete the value 5\nthere is no map from values to indexes\n\nIs O(log n) guaranteed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. A plain heap is fast at the top, not for arbitrary values.', 'next' => 'success'],
                ['label' => 'Yes. Heaps always delete any value in O(log n).', 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nWithout knowing where 5 is, you may have to scan O(n) elements just to find it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'del',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Peek is O(1). Push and pop are O(log n).\n- Building a heap is O(n).\n- Deleting an arbitrary value needs extra bookkeeping.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
