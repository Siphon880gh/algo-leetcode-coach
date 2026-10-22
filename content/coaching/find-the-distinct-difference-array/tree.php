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
            'message' => "Read the problem statement above.\nSuffix for diff[i] starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 's2'],
                ['label' => 'i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums[i] belongs to the prefix only; Example 1 → [−4,−2,0,2,4] instead of [−3,−1,1,3,5].\nStep back to when you started at i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All elements', 'next' => 'wrong_b'],
                ['label' => 'Distinct values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeats count once; Example 2 → [−3,−1,1,3,5] instead of [−2,−1,0,2,3].\nStep back to when you counted every element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [−3,−1,1,3,5], [−2,−1,0,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
