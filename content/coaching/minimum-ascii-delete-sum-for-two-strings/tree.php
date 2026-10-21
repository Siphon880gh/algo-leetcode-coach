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
            'message' => "Read the problem statement above.\nPlain LCS length, then delete the rest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: weight by ASCII, since the longest common subsequence may not be the most valuable', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two common subsequences of equal length can keep different ASCII totals.\nStep back to when you used plain LCS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s1[i] == s2[j]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete both anyway and compare', 'next' => 'wrong_b'],
                ['label' => 'dp[i][j] = dp[i + 1][j + 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keeping a matching pair never costs more.\nStep back to when you deleted the match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "s1 is used up. dp[n1][j] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The ASCII sum of s2[j:]', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The rest of s2 must be deleted at its full cost.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n1 · n2) DP. \"sea\", \"eat\" → 231. \"delete\", \"leet\" → 403.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
