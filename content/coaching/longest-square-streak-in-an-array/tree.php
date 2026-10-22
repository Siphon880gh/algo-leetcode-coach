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
            'message' => "Read the problem statement above.\nA value with no square present?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It is not a streak', 'next' => 's2'],
                ['label' => 'It is a streak of length 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A streak needs at least two values; Example 2 → 1 instead of −1.\nStep back to when you counted single values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Square x how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In 32-bit', 'next' => 'wrong_b'],
                ['label' => 'In 64-bit, or stop once x > 316', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^5 squared is 10^10, past 32-bit range.\nStep back to when you squared in 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
