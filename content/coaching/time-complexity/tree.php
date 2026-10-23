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
            'message' => "State:\nloops ≈ n²/2 iterations\n\nBig-O?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'mid'],
                ['label' => 'O(n²/2) as a different class from O(n²)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nConstants are dropped.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\n3n² + 100n + 5\n\nClass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'final'],
                ['label' => 'O(3n²) distinct from O(n²)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nLeading term’s class is what we keep.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nneed real latency on your machine\n\nBig-O alone enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — also benchmark; constants and cache matter', 'next' => 'success'],
                ['label' => 'Yes — O class predicts exact milliseconds', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAsymptotics hide constants.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Drop constants/lower terms\n- Class ≠ wall clock\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
