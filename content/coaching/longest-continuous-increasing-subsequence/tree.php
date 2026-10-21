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
            'message' => "Read the problem statement above.\nIs this the longest increasing subsequence (problem 300)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: continuous means a subarray', 'next' => 's2'],
                ['label' => 'Yes, with patience sorting', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Elements cannot be skipped.\nStep back to when you used LIS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[i] == nums[i − 1]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Extend the streak', 'next' => 'wrong_b'],
                ['label' => 'Reset the streak to 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Increasing is strict.\nStep back to when you extended on equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you update the best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every step', 'next' => 'success'],
                ['label' => 'Only at a reset', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A streak that runs to the end never resets.\nStep back to when you only updated on resets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass: O(n) time, O(1) space. [1,3,5,4,7] → 3. [2,2,2,2,2] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
