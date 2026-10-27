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
            'message' => "State:\n[3, 1, 4, 1]\nfind a duplicate with a hash set\n\nWhen is the duplicate caught?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the second 1', 'next' => 'mid'],
                ['label' => 'Never, because sets quietly ignore duplicates', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nChecking membership before inserting catches the repeat.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou need fast membership tests\n\nWhich structure do you use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A hash set', 'next' => 'final'],
                ['label' => 'An unsorted list, scanned in full each time', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA hash set is the upgrade from repeated scans.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn inserts and lookups in a hash set\n\nWhat is the expected time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach operation is expected O(1), so n of them take O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A hash table answers \"have I seen this?\"\n- The expected time is O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
