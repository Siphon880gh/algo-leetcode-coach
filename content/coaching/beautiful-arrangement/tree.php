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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fill position 1, 2, … with pruning', 'next' => 's2'],
                ['label' => 'Generate all permutations and filter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 15! is about 1.3e12.\nStep back to when you generated all permutations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At position i, which numbers can you try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any unused number, check at the end', 'next' => 'wrong_b'],
                ['label' => 'Unused x with x % i == 0 or i % x == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any unused number makes the search a full permutation tree again.\nStep back to when you skipped the rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count when i > n. Bitmask DP: f[mask] adds to f[mask | x] when x fits position popcount(mask) + 1. O(2^n n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fill positions 1..n with the divisibility rule', 'next' => 'success'],
                ['label' => 'Use 0-indexed positions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Positions are 1-based. 0-indexed, i = 0 makes i % x = 0 for every x.\nStep back to when you used 0-indexed positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Prune by divisibility at each 1-indexed position. n = 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
