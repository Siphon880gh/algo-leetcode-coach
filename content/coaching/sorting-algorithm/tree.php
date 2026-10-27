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
            'message' => "State:\nyou need a stable O(n log n) sort, and an extra buffer is fine\n\nWhich classic algorithm fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge sort', 'next' => 'mid'],
                ['label' => 'Heap sort, which is stable and needs a Θ(n) buffer', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nHeap sort is not stable, and it works in place.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe array is almost sorted, and n is tiny\n\nWhich simple algorithm fits well?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insertion sort', 'next' => 'final'],
                ['label' => 'Radix sort, always, even for arbitrary objects', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nNearly sorted arrays are where insertion sort shines.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nquicksort on sorted input, using the last element as the pivot\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²), from lopsided partitions', 'next' => 'success'],
                ['label' => 'It is still guaranteed Θ(n log n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThat pivot choice produces lopsided partitions on sorted data.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match the sort to the constraints.\n- Know each algorithm's stability, space and worst case.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
