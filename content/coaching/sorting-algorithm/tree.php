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
            'message' => "State:\nneed stable O(n log n) sort with extra buffer OK\n\nGood classic pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge sort', 'next' => 'mid'],
                ['label' => 'Heap sort — stable and needs Θ(n) buffer', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nHeap sort is not stable and is in-place.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\narray almost sorted, n tiny\n\nStrong simple pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insertion sort', 'next' => 'final'],
                ['label' => 'Always radix — even for arbitrary objects', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nNearly sorted arrays are insertion’s sweet spot.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nquicksort on sorted input with last-element pivot\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) partitions', 'next' => 'success'],
                ['label' => 'Still Θ(n log n) guaranteed', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThat pivot policy skews on sorted data.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match sort to constraints\n- Know stability, space, and worst cases\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
