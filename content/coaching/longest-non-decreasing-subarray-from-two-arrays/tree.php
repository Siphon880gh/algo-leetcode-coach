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
            'message' => "Read the problem statement above.\nPick nums3[i] by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keeping both choices as DP states', 'next' => 's2'],
                ['label' => 'Taking the smallest value that continues', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The smaller value can end a run early; nums1 = [4, 2, 1, 5], nums2 = [4, 4, 3, 5] → 2 instead of 3.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each state extends from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the same array’s state', 'next' => 'wrong_b'],
                ['label' => 'Both previous states', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Runs can switch arrays; nums1 = [3, 1, 2], nums2 = [4, 3, 4] → 2 instead of 3.\nStep back to when you ignored the other array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
