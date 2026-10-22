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
            'message' => "Read the problem statement above.\nFix each window of 3 separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, share raises with a DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Windows overlap; example 1 → 4 instead of 3.\nStep back to when you fixed windows separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] adds the minimum of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous two', 'next' => 'wrong_b'],
                ['label' => 'The previous three dp values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Raised indices may be 3 apart; example 1 → 5 instead of 3.\nStep back to when you used two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
