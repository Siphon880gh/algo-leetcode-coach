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
            'message' => "Read the problem statement above.\nWhere does product_name live?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In Product, so join on product_id', 'next' => 's2'],
                ['label' => 'In Sales', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sales only has the id.\nStep back to when you read it from Sales.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by product?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: one row per sale', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output lists each sale.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'product_name, year, price', 'next' => 'success'],
                ['label' => 'product_name, year, quantity, price', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. quantity is not asked for.\nStep back to when you added quantity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with a hash join. Each sale row appears once with its product name, year, and price.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
