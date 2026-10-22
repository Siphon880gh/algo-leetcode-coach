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
            'message' => "Read the problem statement above.\nOrder keys by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − i', 'next' => 's2'],
                ['label' => 'nums[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The condition involves index gaps; example 1 → 17 instead of 14.\nStep back to when you used nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Every value ≤ 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'wrong_b'],
                ['label' => 'Return the maximum value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The subsequence cannot be empty; example 3 → 0 instead of −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 14, 13, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
