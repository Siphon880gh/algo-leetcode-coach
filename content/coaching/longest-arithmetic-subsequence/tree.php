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
            'message' => "Read the problem statement above.\nState for the DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'End index and difference', 'next' => 's2'],
                ['label' => 'End index only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sequences with different differences cannot extend each other.\nStep back to when you used the index only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] has no entry for d. Length at j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pair nums[i], nums[j] already has two terms.\nStep back to when you used 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How large can d be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Between −500 and 500, so arrays work', 'next' => 'success'],
                ['label' => 'Unbounded, so only maps work', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values are between 0 and 500.\nStep back to when you said unbounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [3,6,9,12] → 4. [9,4,7,2,10] → 3. [20,1,15,3,10,5,8] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
