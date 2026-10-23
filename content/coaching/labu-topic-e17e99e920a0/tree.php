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
            'message' => "State:\n[3,1,4,1] find duplicate via set\n\nWhen caught?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the second 1', 'next' => 'mid'],
                ['label' => 'Never — sets ignore duplicates silently without checks', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nQuery membership before insert catches the repeat.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nmembership test structure\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash set', 'next' => 'final'],
                ['label' => 'Unsorted list with repeated full scans', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHash set is the upgrade.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn inserts/lookups expected\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nExpected O(1) each × n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash answers “seen?”\n- Expected O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
