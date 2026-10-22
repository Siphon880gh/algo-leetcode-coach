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
            'message' => "Read the problem statement above.\nBefore the scan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the numbers', 'next' => 's2'],
                ['label' => 'Keep the input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The running sum assumes earlier values are smaller; example 1 unsorted → 155 instead of 141.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After handling x, update p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p = p + x', 'next' => 'wrong_b'],
                ['label' => 'p = 2p + x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each earlier minimum pairs with twice as many subsets once x can join; example 1 → 125 instead of 141.\nStep back to when you added without doubling.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 141, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
