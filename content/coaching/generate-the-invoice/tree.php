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
            'message' => "Problem: A table Products records product_id and price, and a table Purchases records invoice_id, product_id and quantity. Find the invoice with the highest total price (the sum of quantity times price over its rows), breaking ties as the statement specifies, and report that invoice’s products with their quantity and line price (quantity times price). For instance, if invoices total 130, 180 and 50, report the lines of the 180 invoice. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank invoices by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(quantity × price)', 'next' => 's2'],
                ['label' => 'SUM(quantity)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed invoices 10 and 11 both have 3 items, though 11 totals 180 and 10 only 130.\nStep back to when you summed quantities.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Choose the invoice how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep every invoice whose total equals the maximum', 'next' => 'wrong_b'],
                ['label' => 'Order by total, then the tie-break, LIMIT 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two tied invoices would both be listed, but only one invoice is wanted.\nStep back to when you kept every tied invoice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Line price?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'quantity × price', 'next' => 'success'],
                ['label' => 'price', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Product 3 in invoice 11 → 30 instead of 60.\nStep back to when you dropped the quantity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check → (2, 1, 120), (3, 2, 60).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
