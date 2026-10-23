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
            'message' => "State:\na = [3, 1, 4, 2]\npass 1, first compare\n\nAfter handling 3 vs 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 3, 4, 2] — swapped out-of-order neighbors', 'next' => 'end'],
                ['label' => '[3, 1, 4, 2] — bubble never swaps', 'next' => 'w_noswap'],
            ],
        ],
        'w_noswap' => [
            'message' => "Wrong.\n\nOut-of-order adjacent pairs swap — that is the whole algorithm.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'end' => [
            'message' => "State:\nafter a full pass on that array the suffix holds?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest value so far at the end (4)', 'next' => 'complex'],
                ['label' => 'The smallest value at the end', 'next' => 'w_small'],
            ],
        ],
        'w_small' => [
            'message' => "Wrong.\n\nAscending bubble sinks the next maximum to the right end each pass.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'end',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\nn elements, no early exit\n\nTime class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'O(n log n) like mergesort', 'next' => 'w_nlogn'],
            ],
        ],
        'w_nlogn' => [
            'message' => "Wrong.\n\nNested passes over neighbors are quadratic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Adjacent swaps\n- Each pass freezes the next max at the end\n- O(n²) time, O(1) space\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
