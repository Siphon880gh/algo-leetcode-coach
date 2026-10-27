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
            'message' => "State:\na = [3, 1, 4, 2]\npass 1, first comparison\n\nWhat does the array look like after comparing 3 and 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 3, 4, 2], because the out-of-order neighbors swap', 'next' => 'end'],
                ['label' => '[3, 1, 4, 2], because bubble sort never swaps', 'next' => 'w_noswap'],
            ],
        ],
        'w_noswap' => [
            'message' => "Wrong.\n\nSwapping out-of-order neighbors is the whole algorithm.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'end' => [
            'message' => "State:\none full pass over the array has finished\n\nWhat is now at the end of the array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest value so far, 4', 'next' => 'complex'],
                ['label' => 'The smallest value', 'next' => 'w_small'],
            ],
        ],
        'w_small' => [
            'message' => "Wrong.\n\nIn an ascending bubble sort, each pass carries the next largest value to the right end.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'end',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\nn elements\nno early stop\n\nWhat is the running time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'O(n log n), like merge sort', 'next' => 'w_nlogn'],
            ],
        ],
        'w_nlogn' => [
            'message' => "Wrong.\n\nUp to n passes, each scanning up to n neighbors, is quadratic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Bubble sort swaps neighbors that are out of order.\n- Each pass fixes the next largest value at the end.\n- It takes O(n²) time and O(1) extra space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
