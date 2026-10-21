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
            'message' => "Read the problem statement above.\nScan forward from each day for a warmer one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep a stack of days still waiting', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) on a decreasing run.\nStep back to when you scanned forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A warmer day i arrives. Which days get answers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the top day', 'next' => 'wrong_b'],
                ['label' => 'Every colder day on top of the stack, popped with i − j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One warm day can resolve several waiting days.\nStep back to when you popped one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal temperature. Pop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the wait is for a strictly warmer day', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An equal day is not warmer.\nStep back to when you popped on equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n): each index is pushed and popped once. [73,74,75,71,69,72,76,73] → [1,1,4,2,1,1,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
