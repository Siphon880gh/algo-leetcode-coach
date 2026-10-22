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
            'message' => "Read the problem statement above.\nA banned number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and continue', 'next' => 's2'],
                ['label' => 'Stop the walk', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Larger allowed numbers may still fit; Example 1 → 0 instead of 2.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Accept i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum + i < maxSum', 'next' => 'wrong_b'],
                ['label' => 'sum + i ≤ maxSum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reaching maxSum exactly is allowed; banned = [5], n = 3, maxSum = 6 → 2 instead of 3.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + banned). Examples → 2, 0, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
