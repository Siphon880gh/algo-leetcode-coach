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
            'message' => "Problem: Given a string s and an integer k, return whether s can become a palindrome by removing at most k characters. For instance, \"abca\" with k = 1 gives true and \"abcd\" with k = 2 gives false. (Restated from memory; limits and examples may differ slightly.)\nDelete greedily on the first mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: interval DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Choosing a side early can cost more later.\nStep back to when you deleted greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i] == s[j]. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i + 1][j], dp[i][j − 1])', 'next' => 'wrong_b'],
                ['label' => 'dp[i + 1][j − 1] + 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching ends extend the palindrome.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accept when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − LPS ≤ k', 'next' => 'success'],
                ['label' => 'n − LPS < k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly k removals is allowed.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). \"abca\", k = 1 → true. \"abcd\", k = 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
