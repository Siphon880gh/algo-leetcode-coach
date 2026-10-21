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
            'message' => "Problem: up to 500 × 500 of B and W. Count Bs with no other B in the same row or column. [[W,W,B],[W,B,W],[B,W,W]] → 3. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Precompute B counts per row and per column', 'next' => 's2'],
                ['label' => 'For each B, scan its row and column', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rescanning each B's row and column is O(m n (m + n)).\nStep back to when you rescanned per pixel.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "rows[i] and cols[j] are ready.\nWhen is (i, j) lonely?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'picture[i][j] == B and rows[i] == 1', 'next' => 'wrong_b'],
                ['label' => 'picture[i][j] == B, rows[i] == 1, cols[j] == 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A B alone in its row can share its column. Both must be 1.\nStep back to when you checked only the row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two passes. O(m n) time, O(m + n) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row and column B counts both 1. Not 533', 'next' => 'success'],
                ['label' => 'Count all cells in each row and column', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts are about black pixels. Counting Ws breaks the test.\nStep back to when you counted every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Row and column counters, both equal to 1. → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
