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
            'message' => "Problem: Given a sorted array and a target, return whether the target appears more than half the time. For instance, [2,4,5,5,5,5,5,6,6] with 5 gives true, and [10,100,101,101] with 101 gives false. (Restated from memory; limits and examples may differ slightly.)\nCount with a linear scan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one binary search', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The array is sorted, so O(log n) works.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which index do you find?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any occurrence', 'next' => 'wrong_b'],
                ['label' => 'The first occurrence (lower bound)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The jump must start at the beginning of the run.\nStep back to when you took any match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Majority test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i + n // 2] == target', 'next' => 'success'],
                ['label' => 'nums[i + n // 2 − 1] == target', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That allows exactly half.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [2,4,5,5,5,5,5,6,6], 5 → true. [10,100,101,101], 101 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
