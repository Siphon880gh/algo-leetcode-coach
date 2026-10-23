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
            'message' => "State:\nallocate an output array of length n\n\nAuxiliary space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'mid'],
                ['label' => 'O(1) — output never counts', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nIf you allocate it, it counts unless the problem excludes output.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nrecursion depth up to n on a chain\n\nSpace?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) stack', 'next' => 'final'],
                ['label' => 'O(1) — no explicit array', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nStack frames are space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthree integer locals only\n\nAuxiliary?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'success'],
                ['label' => 'O(n)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFixed locals do not grow with n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count extra arrays/maps and stack depth\n- Input itself usually excluded\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
