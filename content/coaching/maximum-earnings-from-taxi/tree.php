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
            'message' => "Read the problem statement above.\nOverlapping rides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one passenger at a time', 'next' => 's2'],
                ['label' => 'Take every profitable ride', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → 7, not 12; both rides cover point 4.\nStep back to when you took all rides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A ride starting where another ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed', 'next' => 'wrong_b'],
                ['label' => 'Allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The note allows a drop-off and pick-up at the same point.\nStep back to when you forbade it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "dp[i] when no ride ends at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i − 1]', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Earnings carry forward as you drive on.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 7, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
