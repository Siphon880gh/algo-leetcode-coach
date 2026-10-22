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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i]: can the first i elements be split', 'next' => 's2'],
                ['label' => 'Greedily take the longest block that fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 takes [4,4,4] and is stuck with [5,6] → false instead of true.\nStep back to when you chose blocks greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Three different values form a block when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They are strictly increasing', 'next' => 'wrong_b'],
                ['label' => 'Each is exactly one more than the previous', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,2,4] → true instead of false.\nStep back to when you accepted any increase.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "dp[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'success'],
                ['label' => 'false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing can ever become true; Example 1 → false instead of true.\nStep back to when you set dp[0] to false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
