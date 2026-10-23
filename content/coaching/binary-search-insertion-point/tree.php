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
            'message' => "State:\na = [1, 3, 5, 7]\nx = 4\n\nLower_bound insertion index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 — before 5', 'next' => 'mid'],
                ['label' => '1 — before 3', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n3 < 4, so the first ≥4 is index 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nx = 8 on the same array\n\nInsertion index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4 — past the end', 'next' => 'final'],
                ['label' => '3 — overwrite the last element', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nAll elements are < 8, so lower_bound is n = 4.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nduplicates allowed; need first slot for x\n\nPredicate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[i] >= x', 'next' => 'success'],
                ['label' => 'a[i] == x only — fails when x is missing', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLower_bound uses ≥ so it works even when x is missing.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Insertion point = lower_bound\n- May equal n\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
