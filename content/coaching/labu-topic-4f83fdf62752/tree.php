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
            'message' => "State:\ntree above, edges from root to 4\n\nDepth of 4 (edge count)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'mid'],
                ['label' => '0', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nTwo edges: 1→2→4.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nheap array layout needs which shape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Complete (level order left-justified)', 'next' => 'final'],
                ['label' => 'Any sparse tree', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHeaps need complete shape.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nevery level full including last\n\nWord?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Perfect (stricter than merely complete)', 'next' => 'success'],
                ['label' => 'Only “binary”', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPerfect is the full-levels word.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Depth/height conventions\n- Complete vs perfect\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
