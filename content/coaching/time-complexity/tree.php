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
            'message' => "State:\nthe loops run about n²/2 times\n\nWhat is the Big-O?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'mid'],
                ['label' => 'O(n²/2), a different class from O(n²)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nConstants are dropped.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\n3n² + 100n + 5\n\nWhat class is this?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'final'],
                ['label' => 'O(3n²), which is different from O(n²)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nWe keep the class of the leading term.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need the real latency on your machine\n\nIs Big-O alone enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Benchmark too, because constants and the cache matter.', 'next' => 'success'],
                ['label' => 'Yes. The Big-O class predicts the exact milliseconds.', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nBig-O hides constant factors.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Drop constants and lower-order terms.\n- The growth class is not the same as real time.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
