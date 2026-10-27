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
            'message' => "State:\nnums = [5, 1, 9, 3, 7, 8]\nfind the k = 3 largest\nthe min-heap holds at most 3 values\n\nAfter every value is processed, what is on top of the heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7, the smallest of the three largest', 'next' => 'mid'],
                ['label' => '9, as if it were a max-heap of everything', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nA min-heap of the top k has the k-th largest value on top.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe min-heap holds 7, 8 and 9\nthe next value is 6\n\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore 6, because it is not larger than the top, 7', 'next' => 'final'],
                ['label' => 'Push 6 anyway, even if the size goes over k', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nOnce the heap has k values, only a value that beats the top gets in.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nk is much smaller than n\n\nWhat is the time for the size-k heap method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log k)', 'next' => 'success'],
                ['label' => 'O(n log n), necessarily', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach of the n values costs at most O(log k) in heap operations.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Use a min-heap of size k to keep the k largest values.\n- It takes O(n log k) time.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
