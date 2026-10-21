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
            'message' => "Read the problem statement above.\nWhy group by i mod k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent windows force nums[i] = nums[i + k]', 'next' => 's2'],
                ['label' => 'Groups are arbitrary', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sliding a window swaps one element for the one k later.\nStep back to when you ignored the period.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try all 1024 values per class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: present values, plus one "change everything" option', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That costs 1024² per class.\nStep back to when you tried every value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Change-everything cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(previous dp) + class size', 'next' => 'success'],
                ['label' => 'previous dp[x] + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every element of the class changes.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1024 · n). Examples → 3, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
