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
            'message' => "Read the problem statement above.\nTies in strength?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strict on one side, ≤ on the other', 'next' => 's2'],
                ['label' => 'Strict on both sides', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A group with two equal minima is counted twice; [1,1] → 6 instead of 4.\nStep back to when you made both sides strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum of all group sums for one owner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over every group', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums of prefix sums', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With n = 10^5 that is quadratic or worse.\nStep back to when you looped over groups.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to reduce modulo 10^9 + 7?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Three wizards of 10^9 already total 10^19, past 2^63.\nStep back to when you waited for the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 44, 213.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
