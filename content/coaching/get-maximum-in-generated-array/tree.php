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
            'message' => "Read the problem statement above.\nn = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Write nums[1] anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The array has one element.\nStep back to when you wrote index 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd index 2i + 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] + 1', 'next' => 'wrong_b'],
                ['label' => 'nums[i] + nums[i + 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rule sums two earlier entries.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Maximum over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[0..n]', 'next' => 'success'],
                ['label' => 'Only odd indices', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Take the max of the whole array.\nStep back to when you filtered.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 7 → 3, n = 2 → 1, n = 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
