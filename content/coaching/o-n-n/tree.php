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
            'message' => "State:\nn times list.contains on size-n list\n\nReal time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'mid'],
                ['label' => 'O(n) — one call per i', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nEach contains may scan n elements.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nimmutable string builder via repeated s+=c for n chars\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) copying', 'next' => 'final'],
                ['label' => 'Always O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEach append may copy the whole string.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ntimeout though “one loop”\n\nFirst question?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'What does each iteration cost?', 'next' => 'success'],
                ['label' => 'Delete the loop and hope', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAudit the body of the loop.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Multiply by per-iteration cost\n- Watch library pitfalls\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
