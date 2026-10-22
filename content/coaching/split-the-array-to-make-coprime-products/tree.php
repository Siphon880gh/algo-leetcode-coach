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
            'message' => "Read the problem statement above.\nValid split at i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No prime of the prefix appears after i', 'next' => 's2'],
                ['label' => 'gcd(nums[i], nums[i + 1]) = 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Factors can be shared by far-apart elements; Example 1 → 0 instead of 2.\nStep back to when you checked neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range of i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … n − 1', 'next' => 'wrong_b'],
                ['label' => '0 … n − 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right side must be non-empty; Example 2 → 5 instead of −1.\nStep back to when you allowed i = n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). Examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
