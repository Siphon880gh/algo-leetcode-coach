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
            'message' => "State:\ndata = [0.42, 0.11, 0.75, 0.08] in [0,1)\n4 buckets by quarter\n\nWho shares bucket 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0.08 and 0.11', 'next' => 'local'],
                ['label' => '0.75 only', 'next' => 'w_bucket'],
            ],
        ],
        'w_bucket' => [
            'message' => "Wrong.\n\n0.75 falls near the top quarter, not bucket 0.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'local' => [
            'message' => "State:\nafter scatter\n\nNext step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort each bucket, then concatenate', 'next' => 'worst'],
                ['label' => 'Concatenate unsorted buckets — order magically appears', 'next' => 'w_concat'],
            ],
        ],
        'w_concat' => [
            'message' => "Wrong.\n\nBuckets only group by range; local sort creates order inside.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'local',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nall n elements hash to one bucket; local sort is insertion\n\nWorst time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'success'],
                ['label' => 'Still O(n) — buckets guarantee linearity', 'next' => 'w_lin'],
            ],
        ],
        'w_lin' => [
            'message' => "Wrong.\n\nUniformity is an assumption, not a law.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Scatter → local sort → concatenate\n- Average O(n) if buckets stay small\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
