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
            'message' => "State:\na=[4,5,6], read index 1\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'mid'],
                ['label' => 'O(n)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nIndex reads are O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ninsert at index 1\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) shifts', 'next' => 'final'],
                ['label' => 'O(1)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nTail must move.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nmany range sum queries\n\nPrep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums', 'next' => 'success'],
                ['label' => 'Resort every query', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPrefixes answer ranges fast.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- O(1) index; O(n) mid-insert\n- Prefixes for ranges\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
