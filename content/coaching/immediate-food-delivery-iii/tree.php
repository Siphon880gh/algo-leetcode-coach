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
            'message' => "Problem: A deliveries table records, for each order, a customer, an order date and the customer’s preferred delivery date. An order is immediate when the preferred date equals the order date. For each order date, report the percentage of that day’s orders that were immediate, rounded and ordered as the statement says. The exact columns and output names are in the official statement. For instance, a day with 3 orders of which 2 are immediate → 66.67. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order date', 'next' => 's2'],
                ['label' => 'The customer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rows split per customer; a day with one immediate and one late order from two customers → 100.0 and 0.0 instead of one row of 50.0.\nStep back to when you grouped by customer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to write the ratio?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '100 · matches / count', 'next' => 'wrong_b'],
                ['label' => '100.0 · matches / count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. SQLite divides integers; 2 of 3 immediate → 66.0 instead of 66.67.\nStep back to when you wrote 100.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → 66.67, 0.0, 100.0, 50.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
