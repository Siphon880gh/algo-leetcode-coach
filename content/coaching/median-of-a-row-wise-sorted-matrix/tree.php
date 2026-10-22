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
            'message' => "Problem: You are given an m × n matrix in which every row is sorted in non-decreasing order and m · n is odd. Return the median of all its values, aiming for better than looking at every element. For instance, [[1,1,2],[2,3,3],[1,3,4]] → 2; [[1,1,3,3,4]] → 3. (Restated from memory; limits and examples may differ slightly.)\nCount per row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values ≤ x (upper bound)', 'next' => 's2'],
                ['label' => 'Values < x (lower bound)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first constructed matrix → 3 instead of 2.\nStep back to when you counted values below x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm · n / 2', 'next' => 'wrong_b'],
                ['label' => '(m · n + 1) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1,1,3,3,4]] → 1 instead of 3.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count reaches the need at mid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'success'],
                ['label' => 'hi = mid − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid may be the median; the first constructed matrix → 1 instead of 2.\nStep back to when you skipped mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log n log(range)). Constructed checks → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
