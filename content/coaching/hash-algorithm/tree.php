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
            'message' => "State:\ncapacity = 8\nyou need a bucket index\n\nWhat is the last step after computing hash(key)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fold it into range with % 8, or with a bit mask', 'next' => 'mid'],
                ['label' => 'Nothing, because the raw hash is already an index', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nHashes are large integers. You have to fold them into the size of the table.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nevery key is a multiple of 100\nthe hash is key % 1000\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Many collisions, because the pattern in the keys survives', 'next' => 'final'],
                ['label' => 'None, because any modulus spreads keys perfectly', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nKeys with a pattern need real mixing. A weak modulus on its own keeps the pattern.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\na good hash and a low load factor\n\nHow long is a typical bucket chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Short, close to a constant', 'next' => 'success'],
                ['label' => 'Always proportional to n', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nWhen keys spread evenly, buckets stay short.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash the key, then fold it into a bucket index.\n- Aim for an even spread.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
