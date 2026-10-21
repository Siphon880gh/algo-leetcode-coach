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
            'message' => "Read the problem statement above.\nSplit positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … n−1', 'next' => 's2'],
                ['label' => '0 … n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Both substrings must be non-empty.\nStep back to when you allowed empty parts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All ones \"1111\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'wrong_b'],
                ['label' => '3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The left part needs at least one character.\nStep back to when you got 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Recount per split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: running counts', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n²).\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"011101\" → 5. \"00111\" → 5. \"1111\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
