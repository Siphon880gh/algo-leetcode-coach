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
            'message' => "Read the problem statement above.\nInitial dp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0] = 0, others −∞', 'next' => 's2'],
                ['label' => 'All 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Remainders 1 and 2 are not reachable yet.\nStep back to when you set all to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The dp being updated', 'next' => 'wrong_b'],
                ['label' => 'A copy of the old dp', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would use x twice.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0]', 'next' => 'success'],
                ['label' => 'max(dp)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only remainder 0 is divisible by 3.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,6,5,1,8] → 18. [4] → 0. [1,2,3,4,4] → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
