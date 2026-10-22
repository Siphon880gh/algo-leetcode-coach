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
            'message' => "Problem: You are given an array of positive integers. Return how many of its subarrays are strictly increasing; a single element counts as one. For instance, [1,3,5,4,4,6] → 10 and [1,1,1] → 3. (Restated from memory; limits and examples may differ slightly.)\nExtend the run when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The value is bigger than the previous one', 'next' => 's2'],
                ['label' => 'The value is at least the previous one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal values are not strictly increasing; [1,1,1] → 6 instead of 3.\nStep back to when you allowed equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add what to the total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each run’s length once, when it ends', 'next' => 'wrong_b'],
                ['label' => 'The run length at every index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A run of length r holds r(r + 1) / 2 subarrays; [1,3,5,4,4,6] → 6 instead of 10.\nStep back to when you added runs once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Run after a non-increase?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single element counts; [1,1,1] → 0 instead of 3.\nStep back to when you restarted at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 10, 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
