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
            'message' => "Read the problem statement above.\nMust a loose-bound subarray contain minK and maxK?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, its min is minK and its max is maxK', 'next' => 'wrong_a'],
                ['label' => 'No, every value just has to lie between them', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is a different problem. It gives 0 instead of 4 for Example 1.\nStep back to when you required both bounds.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 1 at r = 1 (value 4), stretch starting at 0. How many new subarrays end here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1: just [4]', 'next' => 'wrong_b'],
                ['label' => '2: [4] and [1, 4]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every start in the stretch works, so r − l + 1 = 2. Counting one per element gives 3 instead of 4.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers, adding r − l + 1. O(n). Examples give 4 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
