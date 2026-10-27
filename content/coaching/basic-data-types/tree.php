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
            'message' => "State:\n1000 int32 values packed in an array\n\nAbout how many bytes do the values take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4000', 'next' => 'mid'],
                ['label' => '1000', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nEach int32 takes 4 bytes, and 4 × 1000 = 4000.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou are adding up many large int32 values\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overflow. Use a wider type or modular arithmetic.', 'next' => 'final'],
                ['label' => 'None. Integers never overflow in any language.', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nFixed-size integers either wrap around or raise an error when they overflow.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need exact money totals\n\nWhat should you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole numbers of cents as integers', 'next' => 'success'],
                ['label' => 'Dollars as float64, compared with ==', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFloats are binary approximations, so 0.1 + 0.2 is not exactly 0.3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Space is the element size times n.\n- Watch for integer overflow and inexact floats.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
