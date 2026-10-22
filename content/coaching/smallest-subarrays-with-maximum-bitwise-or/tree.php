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
            'message' => "Read the problem statement above.\nUpdate last[] with nums[i] when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before computing answer[i]', 'next' => 's2'],
                ['label' => 'After computing answer[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Bits of nums[i] then look further away; Example 1 → [4,3,3,2,1] instead of [3,3,2,2,1].\nStep back to when you updated afterwards.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subarray end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(every last[b])', 'next' => 'wrong_b'],
                ['label' => 'max(i, every last[b])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With no bits ahead, last is −1; [1,0] → [1,−1] instead of [1,1].\nStep back to when you dropped i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target OR from i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR of nums[i …]', 'next' => 'success'],
                ['label' => 'OR of the whole array', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Earlier bits are out of reach; in [2,1], index 1 can never make 3.\nStep back to when you used the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(31 · n). Examples → [3,3,2,2,1], [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
