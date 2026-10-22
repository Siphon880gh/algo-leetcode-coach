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
            'message' => "Read the problem statement above.\nAfter the top k, stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, try trading in new categories', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The category bonus can outweigh profit; example 2 → 15 instead of 19.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A new category replaces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheapest item taken', 'next' => 'wrong_b'],
                ['label' => 'The cheapest duplicate-category item', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That can drop a unique category; items [[7, 4], [7, 2], [8, 3], [8, 6], [7, 4], [3, 5]] with k = 5 → 53 instead of 58.\nStep back to when you removed any item.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n), with 64-bit sums. Examples → 17, 19, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
