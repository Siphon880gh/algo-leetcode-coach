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
            'message' => "Read the problem statement above.\nLower which gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 's2'],
                ['label' => 'The smallest non-zero', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Lowering g saves 2g − 1, more for larger gaps; Example 2 → 49 instead of 43.\nStep back to when you lowered small gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Budget left after levelling to t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Lower that many gaps at t by 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 57 instead of 43.\nStep back to when you dropped the leftover.",
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
            'message' => "You are wrong. 10^5 gaps of 10^5 square to 10^15.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(max d)). Examples → 579, 43.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
