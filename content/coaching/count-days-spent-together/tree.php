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
            'message' => "Read the problem statement above.\nOverlap from day a to day b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b − a + 1', 'next' => 's2'],
                ['label' => 'b − a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Both days count; Example 1 → 2 instead of 3.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The later arrival is after the earlier departure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the difference as it is', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice 01-01 to 01-02 and Bob 03-01 to 03-02 → −57 instead of 0.\nStep back to when you skipped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Days in February?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '28', 'next' => 'success'],
                ['label' => '29', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The year is not a leap year; Alice and Bob both 02-01 to 03-01 → 30 instead of 29.\nStep back to when you used 29.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
