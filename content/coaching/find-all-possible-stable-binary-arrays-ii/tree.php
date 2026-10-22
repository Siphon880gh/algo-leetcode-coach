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
            'message' => "Read the problem statement above.\nAfter appending?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract the too-long runs', 'next' => 's2'],
                ['label' => 'Keep every array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 18 instead of 14.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtract which term for a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i − limit][j][1]', 'next' => 'wrong_b'],
                ['label' => 'dp[i − limit − 1][j][1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That removes runs of exactly limit: example 3 → 2 instead of 14.\nStep back to when you subtracted dp[i − limit].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(zero · one). Examples → 2, 1, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
