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
            'message' => "State:\none lookup in an unsorted array, n large\n\nOften enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Linear scan O(n)', 'next' => 'mid'],
                ['label' => 'Must binary search without sorting first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBinary search needs sorted order first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\n10^6 queries “is x present?”\n\nGood investment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash set expected O(1)', 'next' => 'final'],
                ['label' => 'Rescan the array each query', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPreprocess into a set/map.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsorted array, static data\n\nQuery?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search O(log n)', 'next' => 'success'],
                ['label' => 'Hash only — binary search impossible on arrays', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nSorted arrays are binary-search friendly.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pay to preprocess when queries are many\n- Pick structure by need\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
