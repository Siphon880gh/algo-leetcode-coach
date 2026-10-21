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
            'message' => "Read the problem statement above.\nSplits for bag x at penalty m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(x − 1) // m', 'next' => 's2'],
                ['label' => 'x // m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A bag of exactly m needs no split.\nStep back to when you used x // m.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … sum(nums)', 'next' => 'wrong_b'],
                ['label' => '1 … max(nums)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Penalty 0 is impossible and above the max needs nothing.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Always halve the biggest bag?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, binary search instead', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 9 → 6 + 3 → 3 + 3 + 3 beats halving.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
