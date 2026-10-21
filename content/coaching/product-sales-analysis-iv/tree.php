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
            'message' => "Problem: A table Sales records sale_id, product_id, user_id and quantity, and a table Product records product_id and price. For each user, report the product or products on which they spent the most money (quantity times price, summed over their sales), keeping all products on a tie. For instance, a user who spent 100 on one product and 105 on another reports the second; a user who spent 150 on each of three products reports all three. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSpend measured per?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'User and product, summed', 'next' => 's2'],
                ['label' => 'Single sale row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A user’s two sales of one product must add up; in the constructed table user 101 → product 1 instead of product 3.\nStep back to when you ranked single rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rank function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_b'],
                ['label' => 'RANK', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. User 102’s three tied products → 1 row instead of 3.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Partition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'user_id', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the overall top spend survives; user 101 disappears.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (101, 3), (102, 1), (102, 2), (102, 3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
