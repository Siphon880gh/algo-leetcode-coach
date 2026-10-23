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
            'message' => "State:\nmerge sort step after sorting halves\n\nPhase?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Combine — merge two sorted runs', 'next' => 'mid'],
                ['label' => 'Divide again forever', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCombine merges the conquered halves.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nsubproblems recompute the exact same segment many times\n\nLean toward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP / memo rather than pure D&C', 'next' => 'final'],
                ['label' => 'Bigger stacks only', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nOverlap is DP’s signal.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nT(n)=2T(n/2)+O(n)\n\nClass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nMaster theorem / tree of work → n log n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Split, solve, combine\n- Independent subproblems\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
