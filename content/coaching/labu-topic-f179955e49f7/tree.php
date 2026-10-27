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
            'message' => "State:\nmany range sum queries on an array that never changes\n\nWhich pattern fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums', 'next' => 'mid'],
                ['label' => 'Nested loops for every query', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPrefix sums are the upgrade.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\na window with a sum constraint\nthe pointers only move forward\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'final'],
                ['label' => 'O(n²), necessarily', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEach index enters the window once and leaves it once.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\npair up values in a sorted array, working from both ends\n\nWhich pattern fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers from opposite ends', 'next' => 'success'],
                ['label' => 'Prefix sums only', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nWorking from both ends is the classic two-pointer pattern.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pick the array pattern from the clue.\n- Keep the pointers moving forward.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
