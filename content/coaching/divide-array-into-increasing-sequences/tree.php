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
            'message' => "Problem: Given a sorted array nums and an integer k, decide whether it can be split into one or more disjoint strictly increasing subsequences, each of length at least k. For instance, [1,2,2,3,3,4,4] with k = 3 can, and [5,6,6,7,8] with k = 3 cannot. (Restated from memory; limits and examples may differ slightly.)\nSimulate a greedy split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a counting argument decides it', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer depends only on the largest frequency.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why must equal values be in different subsequences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They need not be', 'next' => 'wrong_b'],
                ['label' => 'Each subsequence is strictly increasing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Strictly increasing forbids repeats.\nStep back to when you allowed repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Condition for true?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'maxFreq · k ≤ n', 'next' => 'success'],
                ['label' => 'maxFreq ≤ k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You need maxFreq subsequences of length k each.\nStep back to when you compared with k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,2,3,3,4,4], k = 3 → true. [5,6,6,7,8], k = 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
