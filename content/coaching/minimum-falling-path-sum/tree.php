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
            'message' => "Read the problem statement above.\nPick the smallest cell in each row greedily?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use DP over rows', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The smallest cell now can lead into a costly area, and the next cell must be adjacent.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i][j] = matrix[i][j] + ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min of the whole previous row', 'next' => 'wrong_b'],
                ['label' => 'min(dp[i−1][j−1], dp[i−1][j], dp[i−1][j+1]) within bounds', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You can only move to an adjacent column.\nStep back to when you used the whole row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The minimum of the last row', 'next' => 'success'],
                ['label' => 'dp[n − 1][n − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path can end in any column.\nStep back to when you fixed the corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[2,1,3],[6,5,4],[7,8,9]] → 13. [[-19,57],[-40,-5]] → −59.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
