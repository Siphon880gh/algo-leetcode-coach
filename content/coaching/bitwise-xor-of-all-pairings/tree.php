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
            'message' => "Read the problem statement above.\nnums1’s XOR counts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(nums2) is odd', 'next' => 's2'],
                ['label' => 'len(nums1) is odd', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each nums1 value appears once per nums2 value; Example 1 → 0 instead of 13.\nStep back to when you checked its own length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build nums3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, XOR every pair', 'next' => 'wrong_b'],
                ['label' => 'No, only XOR each array once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is up to 10^5 · 10^5 = 10^10 pairs.\nStep back to when you built the pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 13, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
