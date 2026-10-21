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
            'message' => "Problem: You are given integer arrays nums and costs of length n and start at index 0. From index i you may jump to an index j > i if either nums[i] ≤ nums[j] and every element strictly between them is smaller than nums[i], or nums[i] > nums[j] and every element strictly between them is at least nums[i]. Jumping to j costs costs[j]. Return the minimum total cost to reach index n − 1. For instance, nums [3,2,4,4,1], costs [3,7,6,4,2] → 8; nums [0,1,2], costs [1,1,1] → 2. (Restated from memory; limits and examples may differ slightly.)\nJumps from i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only next ≥ and next smaller', 'next' => 's2'],
                ['label' => 'Check every j > i directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Checking each pair and the values between them is quadratic or worse.\nStep back to when you checked every j.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First rule’s target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Next index with value > nums[i]', 'next' => 'wrong_b'],
                ['label' => 'Next index with value ≥ nums[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values are allowed; nums [0,0,3,0,0], costs [7,7,8,5,9] → unreachable instead of 29.\nStep back to when you required strictly greater.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A jump i → j costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'costs[j]', 'next' => 'success'],
                ['label' => 'costs[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You pay for where you land; the first constructed case → 9 instead of 8.\nStep back to when you charged costs[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 8, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
