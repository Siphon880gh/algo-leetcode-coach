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
            'message' => "State:\na = [3, 1, 4, 2]\nthe max-heap has just been built\n\nWhat is at the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4, the maximum of the array', 'next' => 'extract'],
                ['label' => '1, the minimum of the array', 'next' => 'w_min'],
            ],
        ],
        'w_min' => [
            'message' => "Wrong.\n\nThe root of a max-heap is the maximum.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'extract' => [
            'message' => "State:\nyou keep swapping the root with the last slot, shrinking the heap, and sifting down\n\nWhat are you building?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sorted section of the largest values, growing on the right', 'next' => 'build'],
                ['label' => 'A sorted section of the smallest values, growing on the left', 'next' => 'w_pref'],
            ],
        ],
        'w_pref' => [
            'message' => "Wrong.\n\nClassic heap sort parks each extracted maximum at the end of the array.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'extract',
            'choices' => [],
        ],
        'build' => [
            'message' => "State:\nbuild a heap from n items\n\nHow much does that cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), not O(n log n)', 'next' => 'success'],
                ['label' => 'O(n log n), because you must insert each item into an empty heap', 'next' => 'w_build'],
            ],
        ],
        'w_build' => [
            'message' => "Wrong.\n\nBottom-up heapify is O(n). Pushing the items one at a time would be O(n log n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'build',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Heapify in O(n), then do n sift-downs, for O(n log n) in total.\n- It sorts in place and is not stable.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
