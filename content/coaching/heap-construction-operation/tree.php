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
            'message' => "State:\nn = 5 array, 0-based\n\nLast parent index for bottom-up heapify?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n-2)//2 = 1', 'next' => 'cost'],
                ['label' => 'n-1 = 4 — start sift at the last leaf', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nLeaves already satisfy heap order; start at the last parent.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nbottom-up heapify vs n pushes from empty\n\nFaster build?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Heapify O(n) beats n pushes O(n log n)', 'next' => 'dir'],
                ['label' => 'They are the same big-O always', 'next' => 'w_same'],
            ],
        ],
        'w_same' => [
            'message' => "Wrong.\n\nThe algorithms differ: heapify is linear; repeated push is n log n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'dir' => [
            'message' => "State:\nheapify step at a parent\n\nOperation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sift down — restore heap order in that subtree', 'next' => 'success'],
                ['label' => 'Sift up only — parents never sift down in build', 'next' => 'w_up'],
            ],
        ],
        'w_up' => [
            'message' => "Wrong.\n\nFloyd build sifts **down** from the last parent to the root.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'dir',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Last parent → root, sift down\n- Build O(n), not O(n log n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
