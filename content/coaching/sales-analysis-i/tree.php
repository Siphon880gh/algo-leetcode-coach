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
            'message' => "Problem: A product table lists products, and a sales table records sales with seller, buyer, date, quantity, and the sale's total price; rows may repeat. Report the seller or sellers with the highest total sales price, including ties. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(price)', 'next' => 's2'],
                ['label' => 'SUM(quantity · price)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. price is already the sale's total.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ORDER BY total DESC LIMIT 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: ties would be dropped', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several sellers can share the top total.\nStep back to when you used LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicate rows. Remove them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each row is a recorded sale', 'next' => 'success'],
                ['label' => 'Yes, with DISTINCT', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Duplicates still count.\nStep back to when you removed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. All sellers sharing the top total are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
