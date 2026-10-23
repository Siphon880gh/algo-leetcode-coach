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
            'message' => "State:\nint8 value 127, add 1 in wrapping arithmetic\n\nResult?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-128', 'next' => 'mid'],
                ['label' => '128 stored fine in int8', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nint8 tops out at 127; wrap to -128.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\n0.1 + 0.2 == 0.3 in binary floats?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always exactly', 'next' => 'final'],
                ['label' => 'Always exactly on every CPU', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBinary floats approximate many decimals.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nneed exact cents\n\nStore as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer cents', 'next' => 'success'],
                ['label' => 'float dollars', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nExact money prefers integers.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Two’s complement wrap\n- Floats are approximate\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
