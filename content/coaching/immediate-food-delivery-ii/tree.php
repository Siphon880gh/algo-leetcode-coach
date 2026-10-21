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
            'message' => "Read the problem statement above.\nFirst order means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest order_date per customer', 'next' => 's2'],
                ['label' => 'Smallest delivery_id per customer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first order is by date.\nStep back to when you used the id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All orders', 'next' => 'wrong_b'],
                ['label' => 'Only first orders', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later orders do not count.\nStep back to when you used all orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(100 * share, 2) as immediate_percentage', 'next' => 'success'],
                ['label' => 'The raw share', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is a percentage with 2 decimals.\nStep back to when you returned the share.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example: 2 of 4 first orders immediate → 50.00.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
