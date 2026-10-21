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
            'message' => "Problem: A customers table names customers, and an orders table records products bought. Report customers who bought both A and B but never C. For instance, a customer with A, B, and D qualifies; one with A, B, and C does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nExclude C how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(product = C) = 0 in HAVING', 'next' => 's2'],
                ['label' => 'WHERE product <> C', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. WHERE hides the C orders you must detect.\nStep back to when you filtered in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A and B in one row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: separate rows per order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each order row names one product.\nStep back to when you tested one row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Customer', 'next' => 'success'],
                ['label' => 'Product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The conditions are per customer.\nStep back to when you grouped by product.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One GROUP BY with three HAVING conditions.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
