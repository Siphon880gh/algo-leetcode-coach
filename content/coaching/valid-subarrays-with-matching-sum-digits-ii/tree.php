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
            'message' => "Problem: You get an array nums of positive integers and a digit x. A subarray is valid when the first digit and the last digit of its sum both equal x. Return the number of valid subarrays. It is the same task as Valid Subarrays With Matching Sum Digits I with a much longer array. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount which left ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Range for the first digit, then the right residue', 'next' => 's2'],
                ['label' => 'Only the right residue', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [5, 15, 45, 5], x = 5 → 6 instead of 2.\nStep back to when you skipped the first digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Residue check needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the first-digit range is enough', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [5, 15, 45, 5], x = 5 → 3 instead of 2.\nStep back to when you skipped the last digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · D · log n). Constructed checks → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
