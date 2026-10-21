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
            'message' => "Read the problem statement above.\nMissing count at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i] − i − 1', 'next' => 's2'],
                ['label' => 'arr[i] − i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Positives start at 1.\nStep back to when you dropped the − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer from lo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[lo] − k', 'next' => 'wrong_b'],
                ['label' => 'lo + k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. lo numbers in arr precede it.\nStep back to when you used arr[lo].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All missing past the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo = n handles it', 'next' => 'success'],
                ['label' => 'Special case', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,2,3,4], 2 → 4 + 2 = 6.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [2,3,4,7,11], 5 → 9. [1,2,3,4], 2 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
