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
            'message' => "Problem: A randomised search picks any remaining element as the pivot: if it equals the target it stops; if it is smaller, everything to its left (and itself) is discarded; if larger, everything to its right (and itself) is discarded. Given an array of distinct integers, count the values that are found for every possible sequence of pivot choices. For instance, [7] → 1, [-1,5,2] → 1, and [1,3,2,4,6,5] → 2. (Restated from memory; limits and examples may differ slightly.)\nCondition for x at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(left) < x < min(right)', 'next' => 's2'],
                ['label' => 'x is in sorted position after sorting', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting moves elements; we need the original layout.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why must left elements be smaller?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They are irrelevant', 'next' => 'wrong_b'],
                ['label' => 'A larger left pivot discards x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That pivot removes everything to its right.\nStep back to when you ignored the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Computing the bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix max and suffix min arrays', 'next' => 'success'],
                ['label' => 'Rescan for each i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rescanning is O(n²).\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 1, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
