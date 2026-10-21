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
            'message' => "Read the problem statement above.\nPlain Dijkstra on fees?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it ignores the time limit', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The cheapest path may be too slow.\nStep back to when you ran plain Dijkstra.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0][0] = 0', 'next' => 'wrong_b'],
                ['label' => 'dp[0][0] = fee[0]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The source fee is paid too.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min over t ≤ maxTime of dp[t][n − 1]', 'next' => 'success'],
                ['label' => 'dp[maxTime][n − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You may arrive early.\nStep back to when you used exactly maxTime.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(maxTime · (n + E)). Examples → 11, 48, -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
