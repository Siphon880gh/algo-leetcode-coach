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
            'message' => "Problem: Orders record id, date, customer, and invoice. Per month, report the number of orders and distinct customers among orders whose invoice exceeds the statement's threshold. For instance, two qualifying orders by one customer in a month → orders 2, customers 1. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nThreshold in HAVING?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: WHERE (per order)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The condition is on each order.\nStep back to when you used HAVING.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Customer count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(customer_id)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT customer_id)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeat customers count once.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Month key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Year and month', 'next' => 'success'],
                ['label' => 'Month only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Months from different years would merge.\nStep back to when you dropped the year.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One filtered, grouped query.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
