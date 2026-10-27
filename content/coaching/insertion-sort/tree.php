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
            'message' => "State:\na = [3, 1, 4, 2]\nsorted prefix = [3]\nnext key = 1\n\nWhat does the array look like after inserting the key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 3, 4, 2], because 1 slid left past 3', 'next' => 'best'],
                ['label' => '[3, 1, 4, 2], because insertion sort never moves values left', 'next' => 'w_stay'],
            ],
        ],
        'w_stay' => [
            'message' => "Wrong.\n\nThe key moves left until the prefix is sorted again.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'best' => [
            'message' => "State:\nthe input is already sorted\n\nWhat is the best-case time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because each key compares once and stops', 'next' => 'worst'],
                ['label' => 'Still O(n²), because it always shifts everything', 'next' => 'w_best'],
            ],
        ],
        'w_best' => [
            'message' => "Wrong.\n\nOn sorted input the inner loop does almost no shifting.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'best',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nthe input is sorted in reverse\n\nWhat is the running time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'O(n log n)', 'next' => 'w_nlogn'],
            ],
        ],
        'w_nlogn' => [
            'message' => "Wrong.\n\nEach new key may shift the whole prefix, which is quadratic overall.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Grow a sorted prefix by sliding the next key left.\n- It is fast on nearly sorted data and O(n²) in the worst case.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
