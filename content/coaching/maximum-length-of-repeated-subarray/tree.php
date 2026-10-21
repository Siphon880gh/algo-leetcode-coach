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
            'message' => "Read the problem statement above.\nUse the LCS recurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: subarrays are contiguous, so a mismatch resets to 0', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. LCS allows gaps.\nStep back to when you used LCS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums1[i − 1] == nums2[j − 1]. dp[i][j] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i − 1][j], dp[i][j − 1]) + 1', 'next' => 'wrong_b'],
                ['label' => 'dp[i − 1][j − 1] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A run extends only along the diagonal.\nStep back to when you took the max of neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "With a single row, which direction do you loop j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Backward, so dp[j − 1] still holds the previous row', 'next' => 'success'],
                ['label' => 'Forward', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Forward overwrites dp[j − 1] before you read it.\nStep back to when you looped forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n) time, O(min(m, n)) space. [1,2,3,2,1], [3,2,1,4,7] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
