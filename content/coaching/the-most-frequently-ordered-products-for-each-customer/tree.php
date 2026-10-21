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
            'message' => "Problem: Given customers, orders (customer, product, date) and products tables, report for each customer the product or products they ordered most often, with the product details the statement asks for. Ties are all reported. For instance, a customer who ordered product A twice and B once gets only A. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGrouping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per (customer, product)', 'next' => 's2'],
                ['label' => 'Per product', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer is per customer.\nStep back to when you grouped by product.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_b'],
                ['label' => 'RANK or DENSE_RANK', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ROW_NUMBER drops tied products.\nStep back to when you chose ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Customers without orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They produce no rows', 'next' => 'success'],
                ['label' => 'Report them with NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They have no ordered product to report.\nStep back to when you added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: (1, A), (1, A), (1, B) → A for customer 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
