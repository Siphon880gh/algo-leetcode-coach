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
            'message' => "Problem: In one move you can remove a palindromic subarray, and the rest closes up. Return the fewest moves to remove the whole array. For instance, [1,2] takes 2 and [1,3,4,1,5] takes 3. (Restated from memory; limits and examples may differ slightly.)\nRemove the longest palindrome first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: interval DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy can need more moves.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[i] == arr[k], k ≥ i + 2. Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i + 1][k − 1] + dp[k + 1][j] + 1', 'next' => 'wrong_b'],
                ['label' => 'dp[i + 1][k − 1] + dp[k + 1][j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pair joins the last move inside.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "arr[i] == arr[i + 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + dp[i + 2][j]', 'next' => 'success'],
                ['label' => 'dp[i + 2][j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The pair itself still takes a move.\nStep back to when you made it free.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [1,2] → 2. [1,3,4,1,5] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
