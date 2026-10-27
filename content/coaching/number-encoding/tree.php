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
            'message' => "State:\nan int8 holding 127\nadd 1, with wraparound arithmetic\n\nWhat is the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-128', 'next' => 'mid'],
                ['label' => '128, which fits in an int8', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe largest int8 is 127, so adding 1 wraps around to -128.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nwith binary floats, is 0.1 + 0.2 == 0.3?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always exactly', 'next' => 'final'],
                ['label' => 'Always exactly, on every CPU', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBinary floats can only approximate many decimals.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need exact amounts of money in cents\n\nHow do you store them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As integer cents', 'next' => 'success'],
                ['label' => 'As float dollars', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nExact money calls for integers.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Two's complement integers wrap around.\n- Floats are approximate.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
