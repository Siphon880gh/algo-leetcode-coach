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
            'message' => "Problem: A table Sales records sale_id, product_id, user_id and quantity, and a table Product records product_id and price. For each user, report their total spending (quantity times price, summed over all their sales), ordered by spending from highest to lowest, with ties broken as the statement specifies. For instance, a user who bought 10 units at 10 and 1 unit at 25 spent 125. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSpending of one sale?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'quantity × price', 'next' => 's2'],
                ['label' => 'quantity', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the constructed table user 104 moves to second instead of last.\nStep back to when you dropped the price.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'user_id and product_id', 'next' => 'wrong_b'],
                ['label' => 'user_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. User 101 gets two rows, 100 and 25, instead of one row of 125.\nStep back to when you grouped by product too.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'spending DESC, then the statement’s tie-break', 'next' => 'success'],
                ['label' => 'spending DESC only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Users 102 and 103 both spent 75 and can come out in either order, so the result is not deterministic.\nStep back to when you dropped the tie-break.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (101, 125), then 102 and 103 at 75 in the statement’s tie order, then (104, 70).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
