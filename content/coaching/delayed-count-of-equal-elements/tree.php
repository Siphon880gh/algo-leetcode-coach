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
            'message' => "Problem: You get an integer array nums and an integer k. For each index i, count the indices j with j > i + k and nums[j] = nums[i]. Return the counts as an array. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich j count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j > i + k', 'next' => 's2'],
                ['label' => 'j ≥ i + k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [2, 5, 2, 2, 5], k = 1 → [2, 1, 1, 0, 0] instead of [2, 1, 0, 0, 0].\nStep back to when you included i + k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order at each i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer, then add nums[i + k + 1]', 'next' => 'wrong_b'],
                ['label' => 'Add nums[i + k + 1], then answer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): the same input → [1, 1, 0, 0, 0] instead of [2, 1, 0, 0, 0].\nStep back to when you answered first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → [2, 1, 0, 0, 0], [2, 1, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
