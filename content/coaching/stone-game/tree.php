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
            'message' => "Read the problem statement above.\nPlay greedily, always taking the larger end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: greedy is not optimal in general', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking the larger end can open a bigger pile for the opponent.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why can Alice always win here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'She moves first, so she always wins', 'next' => 'wrong_b'],
                ['label' => 'She can take every even-indexed pile or every odd-indexed one, and their totals differ', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moving first is not enough by itself; the even count and the odd total make the parity strategy work.\nStep back to when you credited the first move.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Want a proof that works for any input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i][j] = max(piles[i] − dp[i+1][j], piles[j] − dp[i][j−1])', 'next' => 'success'],
                ['label' => 'Simulate random games', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Random play proves nothing about optimal play.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) by parity, O(n²) by DP. [5,3,4,5] → true. [3,7,2,3] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
