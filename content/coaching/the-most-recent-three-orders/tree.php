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
            'message' => "Problem: Customers and orders (with dates) are given. For each customer report up to their three most recent orders, ordered as the statement specifies. For instance, five orders → only the latest three appear. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nLIMIT 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: per customer', 'next' => 's2'],
                ['label' => 'Yes, globally', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each customer gets their own three.\nStep back to when you limited globally.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ordering inside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Date ascending', 'next' => 'wrong_b'],
                ['label' => 'Date descending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You want the most recent.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Customers with fewer than three?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Show all they have', 'next' => 'success'],
                ['label' => 'Exclude them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Fewer orders are still reported.\nStep back to when you excluded them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. ROW_NUMBER ≤ 3 per customer.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
