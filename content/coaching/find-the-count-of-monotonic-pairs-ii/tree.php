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
            'message' => "Read the problem statement above.\nSum over u?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums', 'next' => 's2'],
                ['label' => 'A loop per v', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 2 · 10^9 steps.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Previous u allowed when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'u ≤ v', 'next' => 'wrong_b'],
                ['label' => 'u ≤ min(v, v − nums[i] + nums[i − 1])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 10 instead of 4.\nStep back to when you checked only arr1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · max). Examples → 4, 126.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
