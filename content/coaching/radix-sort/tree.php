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
            'message' => "State:\nLSD radix on base-10 integers\n\nFirst digit pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ones place — least significant digit first', 'next' => 'mid'],
                ['label' => 'Highest place first only', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nClassic LSD starts at the least significant digit.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\none digit pass uses unstable quick-partition\n\nProblem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Later passes cannot restore order — need stable passes', 'next' => 'final'],
                ['label' => 'Instability is fine for radix', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nStability is required between digit passes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn keys, d digits, base b\n\nTime shape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(d·(n+b))', 'next' => 'success'],
                ['label' => 'O(n log n) comparisons required', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nRadix avoids key comparisons; it pays d counting passes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- LSD digit passes\n- Each pass stable\n- O(d·(n+b))\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
