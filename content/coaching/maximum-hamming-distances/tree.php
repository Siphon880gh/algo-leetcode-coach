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
            'message' => "Problem: You are given an array of integers that all fit in a stated number of bits. For each element, return the largest Hamming distance (number of differing bits) between it and any element of the array. Limits are in the official statement. For instance, with 4 bits, [9, 12, 9, 11] → [2, 3, 2, 3]. (Restated from memory; limits and examples may differ slightly.)\nRead which distance for nums[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At its complement', 'next' => 's2'],
                ['label' => 'At nums[i] itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums[i] is a source, so every answer is 0: [9, 12, 9, 11] → [0, 0, 0, 0].\nStep back to when you read at nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer from that distance d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd', 'next' => 'wrong_b'],
                ['label' => 'm − d', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [9, 12, 9, 11] → [2, 1, 2, 1] instead of [2, 3, 2, 3].\nStep back to when you returned d.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^m · m). The guide’s checks match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
