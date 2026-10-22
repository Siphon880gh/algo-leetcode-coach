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
            'message' => "Read the problem statement above.\nExtend from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values x − 1 and x + 1', 'next' => 's2'],
                ['label' => 'Only x − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 7 instead of 14.\nStep back to when you used only x − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum[x − 1] + sum[x + 1] + x', 'next' => 'wrong_b'],
                ['label' => 'sum[x − 1] + sum[x + 1] + x · c', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x is added once per new subsequence: example 1 → 8 instead of 14.\nStep back to when you added x once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 14, 40.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
