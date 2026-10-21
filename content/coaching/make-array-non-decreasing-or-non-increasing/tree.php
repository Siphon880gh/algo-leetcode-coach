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
            'message' => "Problem: You are given an integer array nums. In one operation you may add 1 to or subtract 1 from any element. Return the minimum number of operations to make nums non-decreasing or non-increasing. For instance, [3,2,4,5,0] → 4; [2,2,3,4] → 0; [0] → 0. (Restated from memory; limits and examples may differ slightly.)\nWhich target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both, take the smaller', 'next' => 's2'],
                ['label' => 'Only non-decreasing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3,2,4,5,0] → 6 instead of 4.\nStep back to when you dropped non-increasing.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min-heap', 'next' => 'wrong_b'],
                ['label' => 'Max-heap of earlier values', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The fix lowers the largest earlier value, so it must be on top.\nStep back to when you chose a min-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After paying top − x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the top and push x', 'next' => 'success'],
                ['label' => 'Only pop the top', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The lowered value disappears; [3,2,4,5,0] → 3 instead of 4.\nStep back to when you skipped the push.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed cases → 4, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
