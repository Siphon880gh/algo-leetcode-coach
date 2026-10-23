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
            'message' => "State:\nnaive fib call tree\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exponential', 'next' => 'mid'],
                ['label' => 'O(n)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nToo many overlapping calls.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nlinear chain recursion depth n\n\nSpace?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'final'],
                ['label' => 'O(1)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDepth n frames.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nfix for Fib blow-up?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Memo / DP', 'next' => 'success'],
                ['label' => 'Longer variable names', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nCache overlapping states.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Time = work nodes; space ≈ depth\n- Memo when overlapping\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
