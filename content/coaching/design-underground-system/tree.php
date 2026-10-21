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
            'message' => "Read the problem statement above.\nStore every trip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: running totals', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Averaging on each query is slow.\nStep back to when you stored trips.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Route key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unordered pair', 'next' => 'wrong_b'],
                ['label' => '(start, end) in order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Direction matters.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After check-out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove the open trip', 'next' => 'success'],
                ['label' => 'Keep it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The id can check in again later.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Paradise → Cambridge 14, Leyton → Waterloo 11, then 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
