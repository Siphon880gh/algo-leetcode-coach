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
            'message' => "State:\nmax-heap root\n\npeek?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Maximum', 'next' => 'mid'],
                ['label' => 'Minimum', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nMax-heap root is max.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\npush\n\nMechanism?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append + sift up', 'next' => 'final'],
                ['label' => 'Overwrite a random leaf', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nAppend then sift up.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\npriority queue ADT\n\nCommon layout?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary heap', 'next' => 'success'],
                ['label' => 'Unsorted array only forever', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nHeaps give log updates.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Heap implements priority queue\n- Sift up/down\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
