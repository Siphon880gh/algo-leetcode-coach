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
            'message' => "State:\nnums = [2, 1, 3]\n\nWhat is the next greater element for 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'mid'],
                ['label' => '1', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe first larger value to the right of 2 is 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\na monotonic stack\nyou are about to push a bigger value\n\nWhat do you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the smaller values from the top', 'next' => 'final'],
                ['label' => 'Never pop', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPopping keeps the ordering rule intact.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsliding window maximum\n\nWhich structure fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A monotonic deque of indices', 'next' => 'success'],
                ['label' => 'Only a plain stack', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nYou need both ends: drop expired indices from the front and smaller values from the back.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Monotonic stacks and deques solve these patterns.\n- A full pass is amortized O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
