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
            'message' => "Read the problem statement above.\nPair order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Normalize to a < b', 'next' => 's2'],
                ['label' => 'Use as given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, pairs [[2, 1], [3, 2]] → 0 instead of 4.\nStep back to when you skipped normalizing.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gain of removing a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All subarrays containing both its ends', 'next' => 'wrong_b'],
                ['label' => 'max1 − max2 at each r where it holds max1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 5, pairs [[4, 5], [4, 5], [1, 2]] → 8 instead of 11.\nStep back to when you ignored overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + pairs). Examples → 9, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
