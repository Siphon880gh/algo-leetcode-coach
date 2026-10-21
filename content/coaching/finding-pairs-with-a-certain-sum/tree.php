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
            'message' => "Read the problem statement above.\nWhich array to hash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums2 (large, mutable)', 'next' => 's2'],
                ['label' => 'nums1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Then count loops over up to 10^5 elements.\nStep back to when you hashed nums1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only increment the new', 'next' => 'wrong_b'],
                ['label' => 'Decrement the old value, increment the new', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old value no longer exists.\nStep back to when you skipped the decrement.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "count(tot)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ cnt[tot − x] over nums1', 'next' => 'success'],
                ['label' => 'Loop over all pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is up to 10^8 per call.\nStep back to when you looped pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|nums1|) per count. Example → 8, 2, 1, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
