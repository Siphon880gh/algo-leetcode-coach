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
            'message' => "Problem: Given a grid and an integer k, count the submatrices whose largest element is at most k and whose every row is sorted in non-increasing order. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWidth stops when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A value exceeds k or the row increases', 'next' => 's2'],
                ['label' => 'A value exceeds k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[2, 1], [1, 2]], k = 2 → 9 instead of 7.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per column count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current row’s width only', 'next' => 'wrong_b'],
                ['label' => 'Stack of (width, count) over the rows above', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts one-row submatrices only: [[1, 1], [1, 1]], k = 1 → 6 instead of 9.\nStep back to when you used one row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). The guide’s checks → 7, 9, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
