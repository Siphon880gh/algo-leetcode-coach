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
            'message' => "Read the problem statement above.\nTop-right diagonals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-decreasing', 'next' => 's2'],
                ['label' => 'Non-increasing too', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[8, 7, 3], [9, 6, 2], [4, 5, 1]].\nStep back to when you sorted them descending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle diagonal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-decreasing', 'next' => 'wrong_b'],
                ['label' => 'Non-increasing (bottom-left side)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [[0, 1], [1, 2]] instead of [[2, 1], [1, 0]].\nStep back to when you sorted it ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). Examples → [[8, 2, 3], [9, 6, 7], [4, 5, 1]], [[2, 1], [1, 0]], [[1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
