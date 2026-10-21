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
            'message' => "Read the problem statement above.\nCount both kinds with merge sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the counts match iff there is no non-local inversion', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n log n) for a yes/no that needs O(n).\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you detect a non-local inversion in one pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare neighbors', 'next' => 'wrong_b'],
                ['label' => 'Keep the max of nums[0 … i − 2] and compare it with nums[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neighbors are local inversions; the danger is farther apart.\nStep back to when you compared neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Using that the values are 0 … n − 1, what is the shortcut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|nums[i] − i| ≤ 1 for every i', 'next' => 'success'],
                ['label' => 'nums is sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adjacent swaps are allowed; sortedness is too strict.\nStep back to when you required sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,2] → true. [1,2,0] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
