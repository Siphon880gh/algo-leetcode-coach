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
            'message' => "State:\na = [1, 3, 5, 7]\nx = 4\n\nAt which index should 4 be inserted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2, just before 5', 'next' => 'mid'],
                ['label' => '1, just before 3', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n3 is smaller than 4, so 4 goes after it. The first value of at least 4 is 5, at index 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nsame array a = [1, 3, 5, 7]\nx = 8\n\nWhere should 8 go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index 4, just past the end', 'next' => 'final'],
                ['label' => 'Index 3, replacing the last element', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEvery element is smaller than 8, so the insertion point is n, which is 4.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe array may contain duplicates\nyou need the first slot for x\n\nWhich test should the search use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[i] >= x', 'next' => 'success'],
                ['label' => 'a[i] == x only, which fails when x is missing', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe test a[i] >= x still works when x is not in the array, and it lands on the leftmost copy when it is.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- The insertion point is the first index with a[i] >= x.\n- It can be n, just past the end.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
