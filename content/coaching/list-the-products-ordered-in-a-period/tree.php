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
            'message' => "Read the problem statement above.\nThe 100-unit condition goes in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING', 'next' => 's2'],
                ['label' => 'WHERE', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It applies to the per-product total.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Month filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MONTH(order_date) = 2', 'next' => 'wrong_b'],
                ['label' => 'order_date in [2020-02-01, 2020-03-01)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That matches February of every year.\nStep back to when you dropped the year.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product', 'next' => 'success'],
                ['label' => 'Order date', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One row per product is expected.\nStep back to when you grouped by date.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Leetcode Solutions → 130. Leetcode Kit → 100.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
