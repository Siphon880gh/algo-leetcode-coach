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
            'message' => "Read the problem statement above.\nBucket key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit sum of the ball number', 'next' => 's2'],
                ['label' => 'The ball number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The box is chosen by the digit sum.\nStep back to when you used the number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bucket count needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10^5', 'next' => 'wrong_b'],
                ['label' => 'About 46 (sums ≤ 45)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Five digits sum to at most 45.\nStep back to when you sized by the range.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster than per-ball digit sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed for 10^5 balls', 'next' => 'success'],
                ['label' => 'Digit DP is required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Direct counting is fast enough here.\nStep back to when you reached for digit DP.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 2, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
