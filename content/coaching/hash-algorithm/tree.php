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
            'message' => "State:\ncapacity=8, need bucket index\n\nLast step after hash(key)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fold with % 8 (or bitmask)', 'next' => 'mid'],
                ['label' => 'Skip folding — raw hash is already an index', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nHashes are large ints; fold into the table size.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nkeys are always multiples of 100; hash is key%1000\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Many collisions — pattern in keys survives', 'next' => 'final'],
                ['label' => 'None — any % is perfect', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nStructured keys need mixing, not a weak modulus alone.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ngood hash + low load\n\nAverage chain length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Small — near constant', 'next' => 'success'],
                ['label' => 'Always Θ(n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nUniform hashing keeps buckets short.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash then fold into buckets\n- Aim for uniformity\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
