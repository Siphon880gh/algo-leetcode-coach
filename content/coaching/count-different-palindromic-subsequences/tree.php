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
            'message' => "Read the problem statement above.\ns[i] ≠ s[j]. dp[i][j] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i + 1][j] + dp[i][j − 1] − dp[i + 1][j − 1]', 'next' => 's2'],
                ['label' => 'dp[i + 1][j] + dp[i][j − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Palindromes inside both ranges would be counted twice.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i] == s[j] = c and no c inside. Add what to 2 · dp[i + 1][j − 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '2, for "c" and "cc"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both \"c\" and \"cc\" are new.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two or more c inside, the first at l and the last at r. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract dp[l + 1][r − 1]', 'next' => 'success'],
                ['label' => 'Add 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Palindromes inside (l, r) wrapped in c … c were already counted by the inner c pair.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) interval DP mod 10⁹ + 7. \"bccb\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
