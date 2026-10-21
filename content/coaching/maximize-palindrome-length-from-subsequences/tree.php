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
            'message' => "Read the problem statement above.\nAnswer = dp[0][n − 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, both parts must be non-empty', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The best palindrome may lie inside one word.\nStep back to when you returned dp[0][n − 1].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any i, j', 'next' => 'wrong_b'],
                ['label' => 's[i] == s[j] with i < len(word1) ≤ j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The outer pair must cross the boundary.\nStep back to when you recorded any pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No crossing pair at all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without a shared letter no valid palindrome exists.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((m + n)²). Examples → 5, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
