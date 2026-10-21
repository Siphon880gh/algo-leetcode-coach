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
            'message' => "Read the problem statement above.\nDecide greedily whether to swap at each index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track the cost of keeping and of swapping', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Whether to swap depends on later indexes.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a[i − 1] < a[i] and b[i − 1] < b[i]. Transitions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'keep from swap', 'next' => 'wrong_b'],
                ['label' => 'keep from keep, swap from swap + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The straight order holds when both indexes keep or both swap.\nStep back to when you mixed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "a[i − 1] < b[i] and b[i − 1] < a[i]. Transitions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'keep from swap, swap from keep + 1', 'next' => 'success'],
                ['label' => 'keep from keep', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The crossed order holds when exactly one of the two indexes swaps.\nStep back to when you kept both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space. [1,3,5,4], [1,2,3,7] → 1. [0,3,5,8,9], [2,1,4,6,9] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
