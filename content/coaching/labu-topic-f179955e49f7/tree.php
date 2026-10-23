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
            'message' => "State:\nrange sum many times on static array\n\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums', 'next' => 'mid'],
                ['label' => 'Only nested loops forever', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPrefixes are the upgrade.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nwindow sum constraint, pointers only move forward\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'final'],
                ['label' => 'O(n²) required', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEach index enters/leaves once.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsort pairing from both ends\n\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers opposite ends', 'next' => 'success'],
                ['label' => 'Prefix only', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nOpposite ends is classic two pointers.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pick the array pattern by cue\n- Keep pointers monotonic\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
