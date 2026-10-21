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
            'message' => "Problem: Customers, orders, and products are given. For each ordered product, report every order on that product's latest order date, with columns and ordering as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nROW_NUMBER or RANK?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK: ties stay', 'next' => 's2'],
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two orders on the latest date must both appear.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Partition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Customer', 'next' => 'wrong_b'],
                ['label' => 'Product', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The latest is per product.\nStep back to when you partitioned by customer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Products never ordered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not listed', 'next' => 'success'],
                ['label' => 'Listed with NULLs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only ordered products appear.\nStep back to when you listed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Rank-1 orders per product.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
