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
            'message' => "State:\n1000 int32 values in a tight array\n\nPayload bytes ≈?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4000', 'next' => 'mid'],
                ['label' => '1000', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n4 bytes × 1000 = 4000.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nsum many large int32 values\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overflow — use wider type or modular arithmetic', 'next' => 'final'],
                ['label' => 'None — ints never overflow in any language', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nFixed-width ints wrap or throw.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nexact currency totals\n\nPrefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer cents', 'next' => 'success'],
                ['label' => 'float64 dollars with == compares', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFloats are binary approximations.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Width × n for space\n- Watch overflow and float exactness\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
