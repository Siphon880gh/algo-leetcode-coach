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
            'message' => "Problem: Given a product table and an invoices table (each invoice for one product with several amount categories, such as rest, paid, canceled and refunded), report each product's name with the totals of every category over its invoices, ordered as the statement specifies. For instance, two invoices for product A with paid 10 and 5 give A a paid total of 15. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGrouping key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product id (and name)', 'next' => 's2'],
                ['label' => 'Invoice id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The report is one row per product.\nStep back to when you grouped by invoice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Missing sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave NULL', 'next' => 'wrong_b'],
                ['label' => 'IFNULL(SUM(…), 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Totals should read 0, not NULL.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM per category', 'next' => 'success'],
                ['label' => 'MAX per category', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Worth totals all invoices.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: A → paid 15, refunded 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
