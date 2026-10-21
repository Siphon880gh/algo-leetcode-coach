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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bitmask DP, n ≤ 14', 'next' => 's2'],
                ['label' => 'Greedy: match each to its closest XOR', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy choices block better later matches.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nums1 index for mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over all of nums1', 'next' => 'wrong_b'],
                ['label' => 'popcount(mask)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That adds a factor of n and double-counts orders.\nStep back to when you looped nums1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[(1 << n) − 1]', 'next' => 'success'],
                ['label' => 'min over all dp', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every element must be paired.\nStep back to when you took any mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). Examples → 2, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
