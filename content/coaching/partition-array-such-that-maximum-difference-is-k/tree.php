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
            'message' => "Read the problem statement above.\nValue order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Subsequences may skip elements; Example 1 → 4 instead of 2.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare each value with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous value', 'next' => 'wrong_b'],
                ['label' => 'The group’s first (smallest) value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Small steps chain past k; Example 2 → 1 instead of 2.\nStep back to when you compared neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Open a new group when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − start > k', 'next' => 'success'],
                ['label' => 'x − start ≥ k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A difference of exactly k is allowed; Example 3 → 4 instead of 3.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
