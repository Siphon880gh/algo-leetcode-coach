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
            'message' => "Problem: You are given an array books, where books[i] is the number of books on shelf i. You take books from a contiguous range of shelves l … r. From each shelf i in the range you take at most books[i] books, and for every i < r you must take strictly fewer books from shelf i than from shelf i + 1. Return the maximum number of books you can take. For instance, [8,5,2,7,9] → 19; [7,0,3,4,5] → 12; [8,2,3,7,3,4,0,1,4,3] → 13. (Restated from memory; limits and examples may differ slightly.)\nMonotonic stack key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'books[i] − i', 'next' => 's2'],
                ['label' => 'books[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A shelf can cap the run without being smaller; [3,4,6,5,1] → 16 instead of 14.\nStep back to when you keyed by books[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Terms in the run t, t − 1, …?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the shelves available', 'next' => 'wrong_b'],
                ['label' => 'min(t, shelves available)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Takes would go to 0 and below; [7,0,3,4,5] → 11 instead of 12.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Run reaches shelf j with books[j] − j < books[i] − i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add dp[j]', 'next' => 'success'],
                ['label' => 'Add books[j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Shelves left of j may still add books; [8,5,2,7,9] → 16 instead of 19.\nStep back to when you added books[j] alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 19, 12, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
