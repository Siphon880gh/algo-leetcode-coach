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
            'message' => "Problem: A transactions table records which customer made a transaction on which date. For each customer, find their longest run of transactions on consecutive days, then report the customers whose run is the longest of all, ordered as the statement says. The exact columns, whether a customer can have several transactions on one day, and the output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup rows by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Customer and date − ROW_NUMBER()', 'next' => 's2'],
                ['label' => 'Customer only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts all transactions, ignoring gaps; in SQLite the constructed check → 1, 2, 3 instead of 1, 3.\nStep back to when you grouped by customer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Report which customers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The top one with LIMIT 1', 'next' => 'wrong_b'],
                ['label' => 'All whose run equals the maximum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties all count; in SQLite → only 1 instead of 1 and 3.\nStep back to when you used LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The constructed check → customers 1 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
