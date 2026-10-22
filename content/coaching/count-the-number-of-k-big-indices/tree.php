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
            'message' => "Problem: Given an integer array nums and an integer k, an index i is k-big when at least k earlier elements and at least k later elements are smaller than nums[i]. Count the k-big indices. For instance, [2,3,6,5,2,3] with k = 2 → 2 (the values 6 and 5); [1,1,1] with k = 1 → 0. (Restated from memory; limits and examples may differ slightly.)\nWhich earlier and later values count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly smaller ones', 'next' => 's2'],
                ['label' => 'Smaller or equal ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal values are not smaller; [1,1,1] with k = 1 → 1 instead of 0.\nStep back to when you counted equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An index is k-big when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either side has at least k', 'next' => 'wrong_b'],
                ['label' => 'Both sides have at least k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both sides are required; [2,3,6,5,2,3] with k = 2 → 3 instead of 2.\nStep back to when you accepted one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
