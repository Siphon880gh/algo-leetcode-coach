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
            'message' => "Problem: Given an integer array, one operation removes a strictly increasing subsequence. Return the fewest operations that empty the array. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest non-increasing subsequence', 'next' => 's2'],
                ['label' => 'Descents plus one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 3, 1, 4, 2] → 4 instead of 3.\nStep back to when you counted descents.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Replace which tail (negated values)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect left', 'next' => 'wrong_b'],
                ['label' => 'bisect right', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values then share a pile: [2, 2, 2] → 1 instead of 3.\nStep back to when you used bisect left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s checks → 3, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
