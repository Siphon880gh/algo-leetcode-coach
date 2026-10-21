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
            'message' => "Read the problem statement above.\nOne direction enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: type 1 and type 2', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Squares can come from either array.\nStep back to when you did one side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "y with y² = x²?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[y]²', 'next' => 'wrong_b'],
                ['label' => 'cnt[y] · (cnt[y] − 1), then halve', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. j and k must be different indices.\nStep back to when you squared the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overflow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use 64-bit: x² up to 10^10', 'next' => 'success'],
                ['label' => '32-bit is fine', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^5 squared exceeds 32 bits.\nStep back to when you used int.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n1 · d2 + n2 · d1) with d distinct values. Example 1 → 1. Example 2 → 9. Example 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
