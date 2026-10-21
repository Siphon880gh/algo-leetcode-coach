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
            'message' => "Read the problem statement above.\nPositions to track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to min(arrLen, steps / 2 + 1)', 'next' => 's2'],
                ['label' => 'All of arrLen', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. arrLen can be huge, and far cells cannot return in time.\nStep back to when you tracked all of them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i − 1] + dp[i + 1]', 'next' => 'wrong_b'],
                ['label' => 'dp[i] + dp[i − 1] + dp[i + 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Staying is a move too.\nStep back to when you dropped dp[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0] after all steps, mod 10⁹ + 7', 'next' => 'success'],
                ['label' => 'The sum of dp', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You must end at index 0.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(steps · min(steps, arrLen)). (3, 2) → 4. (2, 4) → 2. (4, 2) → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
