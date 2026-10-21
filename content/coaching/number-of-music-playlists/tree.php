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
            'message' => "Read the problem statement above.\nWhat is the DP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length so far and the number of distinct songs used', 'next' => 's2'],
                ['label' => 'Length so far only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Whether a song is new depends on how many have been used.\nStep back to when you dropped the distinct count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many choices for a replay at state j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j', 'next' => 'wrong_b'],
                ['label' => 'max(j − k, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last k songs, all distinct, cannot be replayed yet.\nStep back to when you allowed all j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which cell is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[goal][n]: every song used', 'next' => 'success'],
                ['label' => 'Sum over all j of dp[goal][j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every song must be played at least once.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(goal · n). n = 3, goal = 3, k = 1 → 6. n = 2, goal = 3, k = 0 → 6. n = 2, goal = 3, k = 1 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
