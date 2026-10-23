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
            'message' => "Problem: For each window of length k in an array, find the length of the shortest contiguous segment that must be sorted to make the window non-decreasing (0 if it already is), and return these lengths for the windows from left to right. This guide assumes the array is small enough for O(n · k) work. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nAnswer per window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the first to the last out-of-place position', 'next' => 's2'],
                ['label' => 'The number of misplaced elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Window [3, 2, 1] → 2 instead of 3.\nStep back to when you counted elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Right end of the segment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last index below its left neighbour', 'next' => 'wrong_b'],
                ['label' => 'Last index below the running maximum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 5, 2, 3], k = 4 → [2] instead of [3].\nStep back to when you compared neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n − k + 1) · k). Checks → [2, 0, 2, 0], [4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
