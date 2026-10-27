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
            'message' => "State:\nscan n integers, stored in an array or in a linked list\n\nWhich is usually faster?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The array, which reads cache lines in order', 'next' => 'mid'],
                ['label' => 'The linked list, because pointer jumps are free', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nChasing pointers causes more cache misses.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nboth walks are O(n)\n\nDo they take the same number of milliseconds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not necessarily, because their memory locality differs', 'next' => 'final'],
                ['label' => 'Yes, because the same Big-O means the same time', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nConstant factors and the cache matter.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe CPU fetches memory\n\nWhat unit does it usually load?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A cache line (a block), not one integer at a time', 'next' => 'success'],
                ['label' => 'Exactly one byte per request', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe hardware loads whole lines or blocks.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Contiguous scans stream through the cache.\n- Chasing pointers causes stalls.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
