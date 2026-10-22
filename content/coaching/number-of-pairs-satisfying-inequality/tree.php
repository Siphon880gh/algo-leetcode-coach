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
            'message' => "Read the problem statement above.\nCombine each index into?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums1[i] − nums2[i]', 'next' => 's2'],
                ['label' => 'nums1[i] + nums2[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The nums2 terms switch sides with a minus; nums1 = [−2,2,3], nums2 = [0,0,2], diff = −1 → 3 instead of 2.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count earlier d values that are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< d[j] + diff', 'next' => 'wrong_b'],
                ['label' => '≤ d[j] + diff', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equality satisfies the inequality; Example 1 → 2 instead of 3.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It can reach 10^5 · (10^5 − 1) / 2 ≈ 5 · 10^9.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
