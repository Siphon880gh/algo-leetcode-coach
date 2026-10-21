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
            'message' => "Problem: Given a binary array nums, return the number of subarrays that contain more 1s than 0s, modulo 10^9 + 7. For instance, [0,1,1,0,1] → 9, [0] → 0, [1] → 1. (Restated from memory; limits and examples may differ slightly.)\nA subarray qualifies when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its end prefix is greater than its start prefix', 'next' => 's2'],
                ['label' => 'Its end prefix is at least its start prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal prefixes mean as many 0s as 1s, which is not more.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why is each step O(1)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums are sorted', 'next' => 'wrong_b'],
                ['label' => 'The prefix moves by exactly 1, so one bucket crosses the line', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Prefix sums go up and down; the ±1 step is what keeps the update to one bucket.\nStep back to when you assumed sorted prefixes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return the raw count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, modulo 10^9 + 7', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The task asks for the count modulo 10^9 + 7.\nStep back to when you skipped the modulus.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 9, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
