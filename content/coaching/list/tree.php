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
            'message' => "State:\nsize=2, capacity=2, append 30\n\nFirst need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grow (e.g. to 4), copy, then write', 'next' => 'mid'],
                ['label' => 'Write at index 2 with no growth', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCapacity is full — grow first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nn appends with doubling\n\nAmortized cost each?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'final'],
                ['label' => 'O(n) every append', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nOccasional copies still amortize to O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninsert at middle of length-n dynamic array\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) shifts', 'next' => 'success'],
                ['label' => 'O(1) because of capacity padding', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFree slots at the end do not remove shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Double on full append\n- Amortized O(1) append; mid-insert O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
