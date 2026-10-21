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
            'message' => "Read the problem statement above.\nGreedy largest gcd last?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, DP over masks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairs compete for elements, so greedy can fail.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Operation index for a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fixed per pair', 'next' => 'wrong_b'],
                ['label' => 'popcount(mask) / 2 + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The multiplier depends on how many pairs are already done.\nStep back to when you fixed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Avoid duplicate orderings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always pair the lowest unused element', 'next' => 'success'],
                ['label' => 'Try all pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any pair order leads to the same mask; fixing the lowest prunes repeats.\nStep back to when you tried all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^(2n) · n). Examples → 1, 11, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
