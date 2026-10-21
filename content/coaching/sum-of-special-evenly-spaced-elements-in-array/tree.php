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
            'message' => "Problem: Given an array nums and queries [x, y], answer each with the sum of nums[j] for every j ≥ x where j − x is divisible by y, modulo 1e9+7. For instance, with nums = [0,1,2,3,4,5,6,7], query [0,3] → 0 + 3 + 6 = 9 and [4,2] → 4 + 6 = 10. (Restated from memory; limits and examples may differ slightly.)\nWalk every query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when y ≥ √n', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. y = 1 queries cost O(n) each.\nStep back to when you always walked.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Small-y structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums over the whole array', 'next' => 'wrong_b'],
                ['label' => 'Suffix sums with stride y', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Plain prefix sums mix in skipped indices.\nStep back to when you used plain prefix sums.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Memory?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Build one stride at a time, grouping queries by y', 'next' => 'success'],
                ['label' => 'Store all √n arrays at once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That can be O(n√n) memory.\nStep back to when you stored them all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q)√n). Constructed check → 9, 18, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
