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
            'message' => "State:\ntwo O(n) solutions, one 8× slower in benchmarks\n\nBig-O contradiction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — same class, different constants', 'next' => 'mid'],
                ['label' => 'Yes — Big-O must match milliseconds', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBig-O ignores constants.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nn=15 in a contest\n\nAlways prefer O(n log n) over O(n²)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always — measure; tiny n can favor simpler code', 'next' => 'final'],
                ['label' => 'Yes — lower class always wins at every n', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nConstants and simplicity matter at small n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\narray vs linked list scan of n items\n\nOften faster in practice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array — cache lines stream', 'next' => 'success'],
                ['label' => 'Linked list — pointer chase is free on modern CPUs', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nContiguous scans use cache better.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Big-O for scaling\n- Benchmarks for constants\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
