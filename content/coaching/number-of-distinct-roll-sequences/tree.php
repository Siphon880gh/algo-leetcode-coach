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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last two rolls', 'next' => 's2'],
                ['label' => 'The last roll only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You cannot stop a value repeating two rolls later; n = 3 → 88 instead of 66.\nStep back to when you kept one roll.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum the two-roll table', 'next' => 'wrong_b'],
                ['label' => 'Return 6', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The table holds sequences of length 2; n = 1 → 22 instead of 6.\nStep back to when you skipped the special case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "gcd test for the new roll c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd(b, c) = 1 with the last roll b', 'next' => 'success'],
                ['label' => 'gcd(a, c) = 1 with the roll before', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only adjacent rolls must be coprime; Example 1 → 202 instead of 184.\nStep back to when you tested gcd with a.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 6³). Examples → 184, 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
