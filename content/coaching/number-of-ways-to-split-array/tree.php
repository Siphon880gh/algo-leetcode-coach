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
                ['label' => 'i = 0 … n − 2', 'next' => 's2'],
                ['label' => 'i = 0 … n − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The right part would be empty; Example 2 → 3 instead of 2.\nStep back to when you included the last index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Valid when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'prefix > total − prefix', 'next' => 'wrong_b'],
                ['label' => 'prefix ≥ total − prefix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,1] → 0 instead of 1.\nStep back to when you required strictly greater.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^5 values of 10^5 sum to 10^10, past 2^31.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
