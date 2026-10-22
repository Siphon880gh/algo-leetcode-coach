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
            'message' => "Read the problem statement above.\nEven length: which balance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+1, one more larger than smaller', 'next' => 's2'],
                ['label' => '−1, one more smaller', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The median is the left middle, so k needs an extra larger value; Example 1 → 4 instead of 3.\nStep back to when you used −1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left balances include?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only non-empty left sides', 'next' => 'wrong_b'],
                ['label' => 'The empty left side, balance 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subarrays starting at k vanish; Example 1 → 1 instead of 3.\nStep back to when you dropped the empty side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
