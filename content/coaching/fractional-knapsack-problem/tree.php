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
            'message' => "State:\ndensities 6,5,4; W=50; fractions OK\n\nFirst take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole density-6 item', 'next' => 'mid'],
                ['label' => 'Whole density-4 item first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nGreedy takes highest density first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nsame items but 0-1 (no fractions)\n\nIs density greedy always optimal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — need DP for 0-1', 'next' => 'final'],
                ['label' => 'Yes — greedy always works for knapsacks', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nFractional is the setting where this greedy is safe.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn items\n\nDominant cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log n) sorting by density', 'next' => 'success'],
                ['label' => 'O(nW) DP required', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFractional knapsack is greedy after sorting.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Sort by density\n- Fractions allowed ⇒ greedy OK\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
