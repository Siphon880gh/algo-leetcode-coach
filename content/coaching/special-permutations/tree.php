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
            'message' => "Read the problem statement above.\nSearch over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[mask][last]', 'next' => 's2'],
                ['label' => 'Every permutation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 14! ≈ 8.7 · 10^10 permutations.\nStep back to when you listed permutations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "j may follow last when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when last divides nums[j]', 'next' => 'wrong_b'],
                ['label' => 'Either divides the other', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rule goes both ways; example 1 → 0 instead of 2.\nStep back to when you allowed one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n²). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
