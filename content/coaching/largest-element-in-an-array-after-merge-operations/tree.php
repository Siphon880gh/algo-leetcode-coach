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
            'message' => "Read the problem statement above.\nSweep which way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You stop before the big right values; example 1 → 12 instead of 21.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[i] is bigger than the sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and keep the sum', 'next' => 'wrong_b'],
                ['label' => 'Start a new sum at nums[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It cannot be skipped over; example 1 → 8 instead of 21.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), with 64-bit sums. Examples → 21, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
