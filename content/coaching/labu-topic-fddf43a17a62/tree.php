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
            'message' => "State:\nnums=[2,1,3], next greater of 2\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'mid'],
                ['label' => '1', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nNext greater value to the right is 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nmonotonic stack about to push a bigger value\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop smaller tops first', 'next' => 'final'],
                ['label' => 'Never pop', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPops maintain the invariant.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsliding-window maximum\n\nStructure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Monotonic deque of indices', 'next' => 'success'],
                ['label' => 'Plain stack only', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nNeed both ends: expire front, tighten back.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Mono stack/deque patterns\n- Amortized O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
