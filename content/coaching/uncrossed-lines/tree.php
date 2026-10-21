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
            'message' => "Read the problem statement above.\nConnect the first matching pair you see?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: this is longest common subsequence', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An early match can block two later ones.\nStep back to when you matched greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums1[i − 1] == nums2[j − 1]. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i − 1][j] + 1', 'next' => 'wrong_b'],
                ['label' => 'dp[i − 1][j − 1] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both values are used by the new line.\nStep back to when you took dp[i − 1][j].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "They differ. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i − 1][j], dp[i][j − 1])', 'next' => 'success'],
                ['label' => 'dp[i − 1][j − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Skipping one side may keep a line.\nStep back to when you skipped both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [1,4,2], [1,2,4] → 2. [2,5,1,2,5], [10,5,2,1,5,2] → 3. [1,3,7,1,7,5], [1,9,2,5,1] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
