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
            'message' => "Problem: Design a class over an n × n × n binary array that starts all 0. It can set a cell to 1, set a cell to 0, and report the layer index x whose 2D slice holds the most 1s, choosing the larger x on ties. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSet an already set cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Do nothing', 'next' => 's2'],
                ['label' => 'Count it again', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s check → 0 instead of 1 at the second query.\nStep back to when you counted twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller x', 'next' => 'wrong_b'],
                ['label' => 'Larger x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The guide’s check → 0 instead of 1 at the second query.\nStep back to when you took the smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log q) per operation. The guide’s check → 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
