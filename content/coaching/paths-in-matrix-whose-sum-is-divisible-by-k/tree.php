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
            'message' => "Read the problem statement above.\nCount paths how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over cells and remainders', 'next' => 's2'],
                ['label' => 'List every path', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A 200 × 250 grid has C(448, 199) ≈ 1.7 · 10^132 paths.\nStep back to when you listed paths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seed the start cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0][0][0] = 1', 'next' => 'wrong_b'],
                ['label' => 'dp[0][0][grid[0][0] mod k] = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The start cell’s value is part of every sum; Example 1 → 3 instead of 2.\nStep back to when you seeded remainder 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store counts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mod 10^9 + 7 at every addition', 'next' => 'success'],
                ['label' => 'Exactly, in 64-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A 50 × 50 grid with k = 1 already has C(98, 49) ≈ 2.5 · 10^28 paths.\nStep back to when you skipped the modulus.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · k). Examples → 2, 1, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
