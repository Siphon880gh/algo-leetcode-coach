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
            'message' => "Read the problem statement above.\nEdges needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just the first two', 'next' => 's2'],
                ['label' => 'All of them for degrees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any two edges share only the center.\nStep back to when you counted degrees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "If edges[0][0] is in edges[1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check a third edge', 'next' => 'wrong_b'],
                ['label' => 'It is the center', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two edges are enough to decide.\nStep back to when you checked more.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'success'],
                ['label' => 'O(n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only four numbers are read.\nStep back to when you said O(n).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
