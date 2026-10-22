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
            'message' => "Read the problem statement above.\nClose segments greedily as soon as the sum is big enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use the DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 2, 9, 9] → 2 instead of 3.\nStep back to when you closed greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For i, which j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest such j', 'next' => 'wrong_b'],
                ['label' => 'Latest j with pre[j] + last[j] ≤ pre[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The earliest gives the largest last segment; example 2 → 1 instead of 4.\nStep back to when you took the earliest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
