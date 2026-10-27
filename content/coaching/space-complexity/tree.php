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
            'message' => "State:\nyou allocate an output array of length n\n\nHow much extra space is that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'mid'],
                ['label' => 'O(1), because output never counts', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nIf you allocate it, it counts, unless the problem says output is excluded.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe recursion goes up to n calls deep on a chain\n\nHow much space is that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) of stack', 'next' => 'final'],
                ['label' => 'O(1), because there is no explicit array', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nStack frames take up space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nonly three integer local variables\n\nHow much extra space is that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'success'],
                ['label' => 'O(n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA fixed number of variables does not grow with n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count the extra arrays, maps and stack depth.\n- The input itself is usually not counted.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
