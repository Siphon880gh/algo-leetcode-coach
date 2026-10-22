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
            'message' => "Read the problem statement above.\nSum what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost − cashback of losing transactions only', 'next' => 's2'],
                ['label' => 'cost − cashback of every transaction', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Gains may come last in the worst order; Example 2 → 0 instead of 3.\nStep back to when you added gains.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extra for a losing transaction done last?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its cost', 'next' => 'wrong_b'],
                ['label' => 'Its cashback', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Its own loss is already in the sum; Example 1 → 13 instead of 10.\nStep back to when you added the cost.",
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
            'message' => "You are wrong. Losses sum to about 10^5 · 10^9 = 10^14.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
