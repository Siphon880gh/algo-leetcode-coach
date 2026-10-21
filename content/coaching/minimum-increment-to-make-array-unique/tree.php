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
            'message' => "Read the problem statement above.\nIncrement duplicates one by one, checking a set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort and track the next free value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can be O(n²).\nStep back to when you incremented step by step.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number x arrives with next free value need. It moves to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'need', 'next' => 'wrong_b'],
                ['label' => 'max(need, x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x cannot decrease, and it may already be above need.\nStep back to when you used need.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After placing it at value v, next free = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v + 1', 'next' => 'success'],
                ['label' => 'need + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If x jumped past need, the next free value is above x.\nStep back to when you used need + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,2] → 1. [3,2,1,2,1,7] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
