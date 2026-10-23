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
            'message' => "Read the problem statement above.\nCandidates when 1 < k < n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[0] and nums[n − 1]', 'next' => 's2'],
                ['label' => 'Only nums[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 7.\nStep back to when you dropped the last element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k = n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the same two-ends rule', 'next' => 'wrong_b'],
                ['label' => 'Return max(nums)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 3], k = 2 → −1 instead of 3.\nStep back to when you skipped the special case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
