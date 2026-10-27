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
            'message' => "State:\na = [3, 1, 4, 2]\nthe pass for index 0\n\nWhat do you swap into index 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, the minimum of the whole array', 'next' => 'inv'],
                ['label' => '2, the median', 'next' => 'w_med'],
            ],
        ],
        'w_med' => [
            'message' => "Wrong.\n\nSelection sort pulls in the minimum of the unsorted part.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'inv' => [
            'message' => "State:\nafter 2 passes\n\nWhat is true about the prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[0..1] holds the 2 smallest items, in sorted order', 'next' => 'complex'],
                ['label' => 'Only a[0] is sorted, and the rest is in heap order', 'next' => 'w_inv'],
            ],
        ],
        'w_inv' => [
            'message' => "Wrong.\n\nEach pass extends a sorted prefix with the next smallest value.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'inv',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\nn elements\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²), because each pass scans the rest of the array again', 'next' => 'success'],
                ['label' => 'O(n), from one scan in total', 'next' => 'w_lin'],
            ],
        ],
        'w_lin' => [
            'message' => "Wrong.\n\nFinding n minimums one after another, without a special structure, is quadratic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Each pass swaps the minimum of the unsorted part into place.\n- It takes O(n²) time and O(1) space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
