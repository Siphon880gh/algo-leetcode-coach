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
            'message' => "Read the problem statement above.\nDecide the direction from the first two elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they may be equal', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [2,2,1] starts flat and is still monotonic.\nStep back to when you used the first pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[i] > nums[i − 1]. What does it rule out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-decreasing', 'next' => 'wrong_b'],
                ['label' => 'Non-increasing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A rise breaks the decreasing option.\nStep back to when you ruled out the wrong one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rule nothing out', 'next' => 'success'],
                ['label' => 'Rule both out', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Monotonic allows equal neighbors.\nStep back to when you treated a tie as a break.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [1,2,2,3] → true. [6,5,4,4] → true. [1,3,2] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
