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
            'message' => "Read the problem statement above.\nPrevious dp all negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start fresh: add max(0, ·)', 'next' => 's2'],
                ['label' => 'Must extend', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A subsequence may start at i.\nStep back to when you forced an extension.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan k values', 'next' => 'wrong_b'],
                ['label' => 'Monotonic deque', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(nk).\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max of dp', 'next' => 'success'],
                ['label' => 'dp[n−1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The subsequence can end anywhere.\nStep back to when you used the last dp.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [10,2,-10,5,20], k = 2 → 37. [-1,-2,-3], k = 1 → −1. [10,-2,-10,-5,20], k = 2 → 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
