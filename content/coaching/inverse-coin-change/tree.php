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
            'message' => "Read the problem statement above.\nAdd coin i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'numWays[i] = dp[i] + 1', 'next' => 's2'],
                ['label' => 'numWays[i] > dp[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → [1, 2, 3, 5] instead of [].\nStep back to when you loosened the test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update dp after adding i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's descending', 'next' => 'wrong_b'],
                ['label' => 's ascending (coins reusable)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [] instead of [2, 4, 6].\nStep back to when you went descending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [2, 4, 6], [1, 2, 5], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
