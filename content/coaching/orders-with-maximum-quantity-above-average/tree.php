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
            'message' => "Problem: An order-details table lists, for each order, the products and the quantity of each. An order's average quantity is its total quantity divided by its number of distinct products, and its maximum quantity is its largest single quantity. An order is imbalanced if its maximum quantity is strictly greater than the average quantity of every order (itself included). Report the imbalanced orders' ids, in the order the statement specifies. For instance, with order 1 = {12, 10, 15}, order 2 = {8, 4, 6}, order 3 = {5, 18, 20} and order 4 = {2, 8}, orders 1 and 3 are imbalanced. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nAbove every average means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Above the largest average', 'next' => 's2'],
                ['label' => 'Above the overall average quantity', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each order's own average must be beaten.\nStep back to when you pooled all rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order's average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(quantity) per order', 'next' => 'wrong_b'],
                ['label' => 'AVG(quantity) per order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement divides by the number of products.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strict >', 'next' => 'success'],
                ['label' => '>=', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equality does not make an order imbalanced.\nStep back to when you used >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → orders 1 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
