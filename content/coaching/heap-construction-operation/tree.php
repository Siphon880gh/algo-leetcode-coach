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
            'message' => "State:\nan array of n = 5 items, indexed from 0\n\nAt which index does bottom-up heapify start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − 2) // 2 = 1, the last parent', 'next' => 'cost'],
                ['label' => 'n − 1 = 4, the last leaf', 'next' => 'w_leaf'],
            ],
        ],
        'w_leaf' => [
            'message' => "Wrong.\n\nLeaves have no children, so they already satisfy the heap order. Start at the last parent.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nbottom-up heapify versus n pushes into an empty heap\n\nWhich build is faster?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Heapify, at O(n), beats n pushes at O(n log n)', 'next' => 'dir'],
                ['label' => 'They always have the same Big-O', 'next' => 'w_same'],
            ],
        ],
        'w_same' => [
            'message' => "Wrong.\n\nThey are different algorithms. Heapify is linear, and repeated pushes are n log n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'dir' => [
            'message' => "State:\nheapify is processing one parent\n\nWhich operation does it apply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sift down, to restore the heap order in that subtree', 'next' => 'success'],
                ['label' => 'Sift up only, because a build never sifts down', 'next' => 'w_up'],
            ],
        ],
        'w_up' => [
            'message' => "Wrong.\n\nFloyd's build sifts each parent down, going from the last parent to the root.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'dir',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Go from the last parent to the root, sifting each one down.\n- The build is O(n), not O(n log n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
