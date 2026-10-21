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
            'message' => "Problem: A products table lists, per product and store, the product's price in that store; there is a small fixed set of stores. Report one row per product with its price in each store as a separate column, or null where the product is not sold there, with the column names the statement specifies. For instance, product 0 priced 95, 100, 105 in the three stores and product 1 priced 70 in the first and 80 in the third give (0, 95, 100, 105) and (1, 70, null, 80). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCollapse rows how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY the product', 'next' => 's2'],
                ['label' => 'One self-join per store', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Joins work but conditional aggregation is one pass.\nStep back to when you joined per store.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "CASE without a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ELSE 0', 'next' => 'wrong_b'],
                ['label' => 'No ELSE, so NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A missing store must show NULL.\nStep back to when you added ELSE 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aggregate function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX or SUM of the single match', 'next' => 'success'],
                ['label' => 'COUNT', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. COUNT returns 1, not the price.\nStep back to when you used COUNT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Constructed check → (0, 95, 100, 105), (1, 70, NULL, 80).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
