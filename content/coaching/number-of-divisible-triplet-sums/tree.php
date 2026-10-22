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
            'message' => "Problem: Given an integer array nums and an integer d, count the index triples i < j < k with nums[i] + nums[j] + nums[k] divisible by d. Limits are in the official statement. For instance, [3, 3, 4, 7, 8] with d = 5 → 3, and [1, 2, 3] with d = 3 → 1. (Restated from memory; limits and examples may differ slightly.)\nNeeded remainder for the left item?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(−nums[j] − nums[k]) mod d', 'next' => 's2'],
                ['label' => '(nums[j] + nums[k]) mod d', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The left item must cancel the pair; the examples → 0 and 0 instead of 3 and 1.\nStep back to when you used the pair’s own remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does nums[j] enter the map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before its pairs are counted', 'next' => 'wrong_b'],
                ['label' => 'After its pairs (j, k) are counted', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Then i can equal j; the first example → 6 instead of 3.\nStep back to when you added it first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) time, O(d) space. The examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
