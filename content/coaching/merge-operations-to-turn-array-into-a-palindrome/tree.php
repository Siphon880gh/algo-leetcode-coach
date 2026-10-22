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
            'message' => "Problem: You are given an array of positive integers. In one operation you may replace two adjacent elements with a single element equal to their sum. Return the fewest operations needed to make the array a palindrome. For instance, [1,2,3,1] → 1, [3,1,1,2,3] → 1 and [1,2,1] → 0. (Restated from memory; limits and examples may differ slightly.)\nEnd sums differ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge on the smaller side', 'next' => 's2'],
                ['label' => 'Merge on the larger side', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The larger side only grows further away; [3,1,1,2,3] → 2 instead of 1.\nStep back to when you merged the larger side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "End sums match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge again anyway', 'next' => 'wrong_b'],
                ['label' => 'Move both pointers in and start new sums from the next values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching ends are already a valid pair, and extra merges only add operations; [1,2,1] → more than 0.\nStep back to when you kept merging.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 1, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
