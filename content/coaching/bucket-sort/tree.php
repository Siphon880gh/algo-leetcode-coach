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
            'message' => "State:\ndata = [0.42, 0.11, 0.75, 0.08], all between 0 and 1\n4 buckets, one per quarter of the range\n\nWhich values share bucket 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0.08 and 0.11', 'next' => 'local'],
                ['label' => 'Only 0.75', 'next' => 'w_bucket'],
            ],
        ],
        'w_bucket' => [
            'message' => "Wrong.\n\n0.75 belongs in the third quarter of the range, not the first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'local' => [
            'message' => "State:\nevery value is in its bucket\n\nWhat comes next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort each bucket, then join the buckets in order', 'next' => 'worst'],
                ['label' => 'Join the unsorted buckets, and the order appears by itself', 'next' => 'w_concat'],
            ],
        ],
        'w_concat' => [
            'message' => "Wrong.\n\nBuckets only group values by range. You still have to sort inside each bucket.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'local',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nall n elements land in the same bucket\nbuckets are sorted with insertion sort\n\nWhat is the worst-case time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'Still O(n), because buckets guarantee linear time', 'next' => 'w_lin'],
            ],
        ],
        'w_lin' => [
            'message' => "Wrong.\n\nEven spreading is an assumption, not a guarantee. One huge bucket means one big quadratic sort.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Scatter the values, sort each bucket, then join the buckets.\n- It averages O(n) when the buckets stay small.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
