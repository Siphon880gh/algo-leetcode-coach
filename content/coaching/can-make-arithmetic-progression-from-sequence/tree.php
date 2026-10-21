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
            'message' => "Read the problem statement above.\nCheck gaps unsorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort first', 'next' => 's2'],
                ['label' => 'Use input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rearranging is allowed.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Difference reference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Average gap only', 'next' => 'wrong_b'],
                ['label' => 'a[1] − a[0]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The average can match with unequal gaps.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "O(n) idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min, max, and a set of indices', 'next' => 'success'],
                ['label' => 'Hash all pairwise gaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pairwise is O(n²).\nStep back to when you hashed all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [3,5,1] → true. [1,2,4] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
