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
            'message' => "State:\na=[10,20,30]\nneed a[2]\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'mid'],
                ['label' => 'O(n) walk', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nArrays index in O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ninsert 5 at array index 0\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — shift the tail', 'next' => 'final'],
                ['label' => 'O(1) — arrays never shift', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHead insert shifts every element.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nlinked list head insert\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) with a head pointer', 'next' => 'success'],
                ['label' => 'O(n) always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nRewiring head is O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Array read fast; array mid/head insert shifts\n- List head splice cheap\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
