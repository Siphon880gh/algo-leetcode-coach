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
            'message' => "Problem: Given two equal-length integer arrays nums1 and nums2, count pairs of indices i < j with nums1[i] + nums1[j] > nums2[i] + nums2[j]. For instance, [2,1,2,1] and [1,2,1,2] → 1, and [1,10,6,2] and [1,4,1,5] → 5. (Restated from memory; limits and examples may differ slightly.)\nRewrite the condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd[i] + d[j] > 0', 'next' => 's2'],
                ['label' => 'nums1[i] > nums2[j]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The condition mixes both indices on each side.\nStep back to when you split it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is sorting d allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, index order matters', 'next' => 'wrong_b'],
                ['label' => 'Yes, the condition is symmetric', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each unordered pair is counted once either way.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "d[l] + d[r] > 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add r − l, move r left', 'next' => 'success'],
                ['label' => 'Add 1, move l right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every index from l to r − 1 pairs with r.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check → 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
