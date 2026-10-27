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
            'message' => "State:\nsorted [1, 2, 4, 7]\ntarget sum 6\nL = 0, R = 3\n1 + 7 = 8\n\nWhich pointer moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move R left', 'next' => 'mid'],
                ['label' => 'Move only L right', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe sum is too big on sorted data, so move R left to make it smaller.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nremove the zeros from an array in place\n\nWhich pointer style fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same direction: a slow writer and a fast reader', 'next' => 'final'],
                ['label' => 'Opposite ends only', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nFiltering uses a slow pointer that writes and a fast pointer that reads.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn elements\neach pointer moves at most n times\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPointers that only move forward give linear time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pointers move from opposite ends, or as slow and fast in one direction.\n- Keep an invariant and only move forward.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
