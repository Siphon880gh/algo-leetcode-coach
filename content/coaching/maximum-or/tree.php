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
            'message' => "Read the problem statement above.\nHow to spend the k doublings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All on one number', 'next' => 's2'],
                ['label' => 'Spread them across numbers', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One big shift lifts the top bit furthest; example 2 shifting 8 and 1 once each → 18 instead of 35.\nStep back to when you spread the doublings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "OR of everything except nums[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total OR, then XOR out nums[i]', 'next' => 'wrong_b'],
                ['label' => 'Prefix OR before i with suffix OR after i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. XOR also removes bits other numbers share; [7, 7, 5] with k = 1 → 14 instead of 15.\nStep back to when you XORed nums[i] out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 30, 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
