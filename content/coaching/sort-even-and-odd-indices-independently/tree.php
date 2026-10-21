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
            'message' => "Read the problem statement above.\nWhat to sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even-index and odd-index values separately', 'next' => 's2'],
                ['label' => 'The whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2,3,4,1], not [1,2,3,4].\nStep back to when you sorted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd indices order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-decreasing', 'next' => 'wrong_b'],
                ['label' => 'Non-increasing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 would give [2,1,4,3].\nStep back to when you sorted odd values ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Write back?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Evens to even indices, odds to odd indices', 'next' => 'success'],
                ['label' => 'Evens first, then odds', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 would give [2,4,3,1].\nStep back to when you concatenated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [2,3,4,1], [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
