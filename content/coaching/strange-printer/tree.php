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
            'message' => "Read the problem statement above.\nGreedy: one pass per run of equal letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use interval DP, dp[i][j] = fewest passes for s[i..j]', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"aba\" takes 2 passes, not 3; the outer a's share one pass.\nStep back to when you counted runs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The simplest choice for s[j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i][j − 1]: it is always free', 'next' => 'wrong_b'],
                ['label' => 'Print it alone: dp[i][j − 1] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is free only when it shares a pass with an equal letter.\nStep back to when you made it free.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For k in [i, j) with s[k] == s[j], what does sharing cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i][k] + dp[k + 1][j − 1]', 'next' => 'success'],
                ['label' => 'dp[i][k] + dp[k + 1][j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s[j] joins the pass that prints s[k], so only the middle part k + 1 … j − 1 is printed separately.\nStep back to when you charged for s[j].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Interval DP: O(n³) time, O(n²) space. \"aaabbb\" → 2. \"aba\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
