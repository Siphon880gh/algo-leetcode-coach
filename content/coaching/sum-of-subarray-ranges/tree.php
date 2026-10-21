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
            'message' => "Read the problem statement above.\nRange of every subarray directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: Σ max − Σ min by contribution', 'next' => 's2'],
                ['label' => 'Yes, scan each subarray for its max and min', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³), about 10^9 steps for n = 1000.\nStep back to when you scanned each subarray.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal values in the stack bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≥ on both sides', 'next' => 'wrong_b'],
                ['label' => '≥ on one side, > on the other', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subarrays with equal maxima would be counted for each copy; for [1,3,3] the sum of maxima becomes 22 instead of 16.\nStep back to when you used ≥ twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Result type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values up to 10^9 times many subarrays overflow 32 bits.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 4, 59.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
