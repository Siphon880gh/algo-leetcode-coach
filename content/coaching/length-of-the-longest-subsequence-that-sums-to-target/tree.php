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
            'message' => "Read the problem statement above.\nStarting dp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0] = 0, others −1', 'next' => 's2'],
                ['label' => 'All zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Unreachable sums then look reachable; example 3 → 2 instead of −1.\nStep back to when you started at all zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Upward', 'next' => 'wrong_b'],
                ['label' => 'Downward', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Upward reuses the same number; example 3 → 3 instead of −1.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · target). Examples → 3, 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
