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
            'message' => "Read the problem statement above.\nBase cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ |nums1[i] − nums2[i]| + 1 for the append', 'next' => 's2'],
                ['label' => 'Σ |nums1[i] − nums2[i]| only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 4.\nStep back to when you forgot the append.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost to get nums2[n]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Copy only the original nums1[i]', 'next' => 'wrong_b'],
                ['label' => 'Copy nums1[i] at any moment while it moves toward nums2[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 4 instead of 3.\nStep back to when you copied only original values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
