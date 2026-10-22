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
            'message' => "Read the problem statement above.\nEqual characters at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip for free: dp[i + 1] = dp[i]', 'next' => 's2'],
                ['label' => 'Must be covered by a rule', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 starts with a, which no rule covers; → −1 instead of 9.\nStep back to when you required a rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Conversions chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: direct rules only', 'next' => 'wrong_b'],
                ['label' => 'Yes: Floyd–Warshall among same-length strings', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 needs fgh → thh → ghh; → −1 instead of 9.\nStep back to when you used direct rules only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 28, 9, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
