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
            'message' => "Read the problem statement above.\nDP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last remainder and the one before it', 'next' => 's2'],
                ['label' => 'Last remainder only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That lets any value follow: example 2 → 6 instead of 4.\nStep back to when you kept one remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[p][v] extends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[p][v]', 'next' => 'wrong_b'],
                ['label' => 'dp[v][p]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pattern must alternate: example 1 → 3 instead of 5.\nStep back to when you used dp[p][v].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n k). Examples → 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
