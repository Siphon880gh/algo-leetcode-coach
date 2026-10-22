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
            'message' => "Problem: You get two integer arrays nums1 and nums2 of equal length; index i stands for the point (nums1[i], nums2[i]). Find the pair of indices whose points are closest in Manhattan distance |nums1[i] − nums1[j]| + |nums2[i] − nums2[j]|, and return it as two indices. Ties between pairs are broken by an index rule given in the official statement, along with the exact limits. For instance, nums1 = [1,4,9,5], nums2 = [1,6,2,5] → [1,3], at distance 2. (Restated from memory; limits and examples may differ slightly.)\nIn the strip sorted by y, compare each point with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every later point within d in y', 'next' => 's2'],
                ['label' => 'Only the next point', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The closest partner may not be adjacent in y; nums1 = [3,0,8,2], nums2 = [4,4,0,3] → [0,1] instead of [0,3].\nStep back to when you checked one neighbour.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance between two points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Euclidean', 'next' => 'wrong_b'],
                ['label' => '|Δx| + |Δy|', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A different metric can pick a different pair; nums1 = [3,2,5], nums2 = [9,4,0] → [1,2] instead of [0,1].\nStep back to when you used Euclidean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log² n). Constructed check → [1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
