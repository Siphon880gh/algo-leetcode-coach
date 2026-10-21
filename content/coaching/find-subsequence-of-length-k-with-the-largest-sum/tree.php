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
            'message' => "Read the problem statement above.\nWhich elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k largest values', 'next' => 's2'],
                ['label' => 'The first k elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2's first three sum to 0, but [-1,3,4] sums to 6.\nStep back to when you took the first k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted by value', 'next' => 'wrong_b'],
                ['label' => 'Original index order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A subsequence keeps the original order; Example 2 → [-1,3,4], not [4,3,-1].\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After choosing indices by value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort those indices ascending', 'next' => 'success'],
                ['label' => 'Use them in the order chosen', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The order chosen follows value, not position.\nStep back to when you skipped sorting the indices.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [3,3], [-1,3,4], [3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
