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
            'message' => "State:\nintervals (1,3),(2,4),(3,5)\nmax non-overlapping\n\nFirst pick by end time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(1,3)', 'next' => 'mid'],
                ['label' => '(2,4)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nEarliest end is (1,3).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ngreedy passed one test\n\nEnough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — need proof or known pattern', 'next' => 'final'],
                ['label' => 'Yes always', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nSamples do not prove optimality.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ncannot prove; counterexample found\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Switch to DP/search', 'next' => 'success'],
                ['label' => 'Ignore the counterexample', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nUnsafe greedy must go.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Selection key + proof\n- Interval earliest-end is a classic safe pattern\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
