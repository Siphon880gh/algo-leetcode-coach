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
            'message' => "State:\na=[1,3,5,7,9], target 7, mid value 5\n\nNext?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search right half', 'next' => 'mid'],
                ['label' => 'Search left half', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n7 > 5 ⇒ discard left.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\neach step halves the range\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log n)', 'next' => 'final'],
                ['label' => 'O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHalving yields log steps.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nneed first occurrence of a duplicate key\n\nPlain “any hit” enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — use a boundary binary search', 'next' => 'success'],
                ['label' => 'Yes — any index is always fine', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFirst/last need biased updates.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Halve via mid tests\n- Keep a range invariant\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
