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
            'message' => "Read the problem statement above.\nCan all run T minutes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ min(b, T) ≥ n · T', 'next' => 's2'],
                ['label' => 'Σ b ≥ n · T', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 2, batteries [10, 1]: the plain sum allows T = 5, but one battery can only power one computer at a time, so the answer is 1.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the largest T?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every T from the sum downward', 'next' => 'wrong_b'],
                ['label' => 'Binary search: the check is monotone', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. T can reach about 10^14 / n, far too many values to try.\nStep back to when you scanned T.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 10^5 batteries of up to 10^9 sum to 10^14.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log(sum / n)). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
