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
            'message' => "Read the problem statement above.\nNeed the characters to be adjacent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a subsequence keeps order only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is a substring.\nStep back to when you required adjacency.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "text1[i − 1] == text2[j − 1]. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i − 1][j], dp[i][j − 1]) + 1', 'next' => 'wrong_b'],
                ['label' => 'dp[i − 1][j − 1] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The matched letter can be used once.\nStep back to when you added to the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letters differ. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i − 1][j], dp[i][j − 1])', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is for substrings.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). \"abcde\", \"ace\" → 3. \"abc\", \"def\" → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
