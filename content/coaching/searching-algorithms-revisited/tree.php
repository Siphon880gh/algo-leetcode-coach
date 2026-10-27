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
            'message' => "State:\none lookup in a large unsorted array\n\nWhat is often enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A linear scan, O(n)', 'next' => 'mid'],
                ['label' => 'Binary search, without sorting first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBinary search only works on sorted data.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\n10^6 queries asking \"is x present?\"\n\nWhat is a good investment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A hash set, with expected O(1) lookups', 'next' => 'final'],
                ['label' => 'Scanning the array again for each query', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreprocess the data into a set or map.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\na sorted array that never changes\n\nHow do you answer queries?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search, O(log n)', 'next' => 'success'],
                ['label' => 'Only with a hash, since binary search is impossible on arrays', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nSorted arrays are ideal for binary search.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pay for preprocessing when there are many queries.\n- Choose the structure by what you need.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
