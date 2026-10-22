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
            'message' => "Problem: Two tables describe purchases: one lists transactions with a customer, a product, an amount and a date, and one gives each product’s category. For each customer, report summary figures about their purchases, such as totals, counts and averages, their top category, and a score built from these, all as the statement defines. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTop category?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER by count, then latest', 'next' => 's2'],
                ['label' => 'MIN(category)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check customer 7 → Books instead of Toys.\nStep back to when you took MIN.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Totals grouped by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Customer and category', 'next' => 'wrong_b'],
                ['label' => 'Customer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That returns one row per category.\nStep back to when you grouped by category.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → (7: 60, 3, 2, 20, Toys), (8: 40, 2, 2, 20, Games).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
