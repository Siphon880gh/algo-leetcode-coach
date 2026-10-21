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
            'message' => "Read the problem statement above.\nTrack individual words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: per-column letter counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only how many words have that letter in that column matters.\nStep back to when you tracked words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update direction within a column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i from low to high', 'next' => 'wrong_b'],
                ['label' => 'i from high to low', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ascending reuses one column twice.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Transition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i + 1] += dp[i] · cnt[k][target[i]]', 'next' => 'success'],
                ['label' => 'dp[i + 1] = dp[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each matching word in the column is a separate choice.\nStep back to when you dropped the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L · (W + |target|)). Examples → 6, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
