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
            'message' => "Read the problem statement above.\nWhat is dp[k][i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best score for the first i elements in at most k groups', 'next' => 's2'],
                ['label' => 'The best score using exactly element i as a group', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The state must cover a whole prefix.\nStep back to when you defined it per element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[k − 1][i − 1] + nums[i − 1]', 'next' => 'wrong_b'],
                ['label' => 'max over j of dp[k − 1][j] + avg(j … i − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last group can start anywhere, not just at i − 1.\nStep back to when you fixed its length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is it ever worse to use more groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: with positive numbers, splitting a group never lowers the score', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A whole's average is at most the sum of its parts' averages.\nStep back to when you feared more groups.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · n²). [9,1,2,3,9], k = 3 → 20.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
