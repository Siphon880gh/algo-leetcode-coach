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
            'message' => "Read the problem statement above.\nWhen nums[i] = nums[i + 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] doubles, nums[i + 1] becomes 0', 'next' => 's2'],
                ['label' => 'nums[i + 1] doubles, nums[i] becomes 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The doubled value then merges again; [2,2,4] → [8,0,0] instead of [4,4,0].\nStep back to when you doubled the right one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Move the zeros how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort descending', 'next' => 'wrong_b'],
                ['label' => 'Keep the other values in order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [4,2,1,0,0,0] instead of [1,4,2,0,0,0].\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,4,2,0,0,0], [1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
