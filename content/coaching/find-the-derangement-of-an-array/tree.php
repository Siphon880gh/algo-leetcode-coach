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
            'message' => "Problem: Count the permutations of 1..n in which no element stays in its own position, modulo 1e9 + 7 (n up to 10⁶). n = 3 → 2 ([2,3,1] and [3,1,2]). (Restated from memory; limits and examples may differ slightly.)\nEnumerate the permutations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: find a recurrence on where element 1 goes', 'next' => 's2'],
                ['label' => 'Yes, and count the valid ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n! is impossible for n = 10⁶.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Element 1 goes to position k. What cases follow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the swap case, D(n − 2)', 'next' => 'wrong_b'],
                ['label' => 'k goes to position 1 (D(n − 2)) or it does not (D(n − 1)), for each of n − 1 choices of k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. When k does not go to position 1, the remaining n − 1 elements each avoid one spot, which counts as D(n − 1).\nStep back to when you dropped that case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What are the base cases?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'D(1) = 0 and D(2) = 1', 'next' => 'success'],
                ['label' => 'D(1) = 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With one element it always stays in place, so there are no derangements.\nStep back to when you set D(1) = 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. D(n) = (n − 1)(D(n − 1) + D(n − 2)) mod 1e9 + 7, two rolling values: O(n) time, O(1) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
