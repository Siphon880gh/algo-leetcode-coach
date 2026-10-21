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
            'message' => "Problem: A table holds distinct integer positions on a line. Return the smallest distance between any two of them. For instance, points −1, 0, 2 give 1. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nIn sorted order, what is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest gap between neighbors', 'next' => 's2'],
                ['label' => 'MAX(x) − MIN(x)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is the widest span, not the closest pair.\nStep back to when you took the span.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get the previous point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LAG(x) OVER ()', 'next' => 'wrong_b'],
                ['label' => 'LAG(x) OVER (ORDER BY x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without ORDER BY the row order is undefined, so the previous row is arbitrary.\nStep back to when you dropped the ORDER BY.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The first row's LAG is NULL. Is that a problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: MIN ignores NULL', 'next' => 'success'],
                ['label' => 'Yes: replace it with 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Using 0 would make a fake point at 0 and a fake distance.\nStep back to when you replaced the NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. MIN(x − LAG(x) OVER (ORDER BY x)): O(n log n). → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
