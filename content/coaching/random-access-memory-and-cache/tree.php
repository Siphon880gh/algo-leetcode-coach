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
            'message' => "State:\nscan n ints in an array vs linked list\n\nUsually faster?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array — sequential cache lines', 'next' => 'mid'],
                ['label' => 'Linked list — jumps are free', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPointer chasing misses cache more.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nboth walks are O(n)\n\nSame milliseconds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not necessarily — locality differs', 'next' => 'final'],
                ['label' => 'Yes — Big-O identical means identical time', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nConstants and cache matter.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nCPU fetches memory\n\nUnit often?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cache line (block), not one int at a time', 'next' => 'success'],
                ['label' => 'Exactly one byte per request always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nHardware loads lines/blocks.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Contiguous scans stream\n- Pointer chase stalls\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
