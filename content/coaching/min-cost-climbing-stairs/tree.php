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
            'message' => "Read the problem statement above.\nWhere is the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index n, one past the last step', 'next' => 's2'],
                ['label' => 'The last step, n − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You must climb past the last step.\nStep back to when you stopped at n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[0] and dp[1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost[0] and cost[1]', 'next' => 'wrong_b'],
                ['label' => 'Both 0: you may start on either for free', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Standing on the start steps is free; you pay when you leave them.\nStep back to when you charged the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "dp[i] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(dp[i − 1] + cost[i − 1], dp[i − 2] + cost[i − 2])', 'next' => 'success'],
                ['label' => 'min(dp[i − 1], dp[i − 2]) + cost[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That pays for the step you arrive on, and the top has no cost.\nStep back to when you charged the arrival.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space. [10,15,20] → 15. [1,100,1,1,1,100,1,1,100,1] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
