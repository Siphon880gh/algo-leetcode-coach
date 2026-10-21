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
            'message' => "Read the problem statement above.\nCounting coverage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference array plus prefix sum', 'next' => 's2'],
                ['label' => 'Loop each request range', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · q).\nStep back to when you looped ranges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairing rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Original order', 'next' => 'wrong_b'],
                ['label' => 'Largest value to largest count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You may permute nums freely.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reduce mod 1e9+7 (sum fits in 64 bits)', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must be returned mod 1e9+7.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + q). Examples → 19, 11, 47.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
