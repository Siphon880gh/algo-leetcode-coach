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
            'message' => "Read the problem statement above.\nSimulate many games?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: dp[i] = probability of ever holding i points', 'next' => 's2'],
                ['label' => 'Yes, Monte Carlo', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer must be exact to within 10⁻⁵.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(sum of all earlier dp) / maxPts', 'next' => 'wrong_b'],
                ['label' => '(sum of dp[j] for i − maxPts ≤ j < i, j < k) / maxPts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You only draw while j < k, and a draw adds at most maxPts.\nStep back to when you summed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you keep that sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sliding window: add dp[i] if i < k, drop dp[i − maxPts]', 'next' => 'success'],
                ['label' => 'Recompute it for each i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n · maxPts).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Answer = sum of dp[k..n] (1.0 when k = 0). n = 10, k = 1, maxPts = 10 → 1.0. n = 6, k = 1, maxPts = 10 → 0.6. n = 21, k = 17, maxPts = 10 → 0.73278.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
