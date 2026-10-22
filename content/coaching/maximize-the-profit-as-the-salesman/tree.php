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
            'message' => "Read the problem statement above.\nChoose offers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over end houses', 'next' => 's2'],
                ['label' => 'Biggest offer first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It blocks two that fit together; example 1 → 2 instead of 3.\nStep back to when you took the biggest offer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[e + 1] starts from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'dp[e]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Profit is lost at unsold houses; example 1 → 0 instead of 3.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
