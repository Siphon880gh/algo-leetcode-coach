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
            'message' => "Read the problem statement above.\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums2, largest first', 'next' => 's2'],
                ['label' => 'nums1, largest first, and take the top k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A small nums2 among them ruins the product; Example 1 → 8 instead of 12.\nStep back to when you sorted by nums1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap too big; remove?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest nums1', 'next' => 'wrong_b'],
                ['label' => 'The smallest nums1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keep the biggest sums; nums1 = [4,1], nums2 = [6,7], k = 1 → 7 instead of 24.\nStep back to when you removed the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 12, 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
