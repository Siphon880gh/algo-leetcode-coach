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
            'message' => "State:\na = [3, 1, 4, 2]\nsorted prefix = [3]\nnext key = 1\n\nAfter inserting key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 3, 4, 2] — 1 slid left past 3', 'next' => 'best'],
                ['label' => '[3, 1, 4, 2] — insertion never moves left', 'next' => 'w_stay'],
            ],
        ],
        'w_stay' => [
            'message' => "Wrong.\n\nThe key walks left until the prefix stays sorted.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'best' => [
            'message' => "State:\ninput already sorted\n\nBest-case time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — each key compares once and stops', 'next' => 'worst'],
                ['label' => 'Still O(n²) — always shifts everything', 'next' => 'w_best'],
            ],
        ],
        'w_best' => [
            'message' => "Wrong.\n\nOn sorted input the inner loop does almost no shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'best',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nreverse-sorted input\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'O(n log n)', 'next' => 'w_nlogn'],
            ],
        ],
        'w_nlogn' => [
            'message' => "Wrong.\n\nEach new key may shift the whole prefix — quadratic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Grow a sorted prefix by sliding the next key left\n- Fast on nearly sorted data; O(n²) worst\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
