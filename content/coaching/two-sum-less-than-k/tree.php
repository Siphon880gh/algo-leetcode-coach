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
            'message' => "Problem: Given an integer array nums and an integer k, return the largest nums[i] + nums[j] with i < j that is strictly less than k, or −1 if no pair qualifies. For instance, nums = [10,20,30] with k = 45 gives 40, and with k = 15 gives −1. (Restated from memory; limits and examples may differ slightly.)\nTry every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort and use two pointers', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum is below k. Move which pointer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right', 'next' => 'wrong_b'],
                ['label' => 'Left, after recording the sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moving right only lowers the sum.\nStep back to when you moved right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum equals k. Record it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it must be strictly less', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal to k does not qualify.\nStep back to when you recorded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [10,20,30], k = 45 → 40. [10,20,30], k = 15 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
