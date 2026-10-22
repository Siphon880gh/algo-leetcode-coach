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
            'message' => "Read the problem statement above.\nCandidate x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums2[0] − one of nums1’s three smallest', 'next' => 's2'],
                ['label' => 'min(nums2) − min(nums1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The minimum may be removed: example 1 → 6, which does not fit.\nStep back to when you used the minimum only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try them in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest nums1 value first', 'next' => 'wrong_b'],
                ['label' => 'Largest nums1 value first (smallest x)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That returns the largest valid x: example 2 → 4 instead of 2.\nStep back to when you started from the smallest value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → −2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
