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
            'message' => "Problem: Three tables describe the salespeople, the customers each salesperson serves, and the sales made to those customers with their prices. For every salesperson, report the total price of the sales made to their customers, including salespeople whose total is 0. For instance, a salesperson with customers who bought for 40, 5 and 25 has 70; one whose only customer bought nothing has 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Salespeople LEFT JOIN customers LEFT JOIN sales', 'next' => 's2'],
                ['label' => 'Inner joins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Salespeople with no sales vanish; the constructed check keeps only one of three.\nStep back to when you used inner joins.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total for nobody’s sales?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(price)', 'next' => 'wrong_b'],
                ['label' => 'COALESCE(SUM(price), 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is NULL instead of 0 for two salespeople in the constructed check.\nStep back to when you left the sum bare.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The salesperson', 'next' => 'success'],
                ['label' => 'Salesperson and customer', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One row per customer; the salesperson with 70 appears as 45 and 25.\nStep back to when you grouped by customer too.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (SQLite) → 70, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
