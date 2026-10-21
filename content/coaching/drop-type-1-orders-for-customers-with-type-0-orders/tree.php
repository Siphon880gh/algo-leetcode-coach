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
            'message' => "Problem: An orders table lists an order id, a customer id and an order type, which is 0 or 1. Report the orders that remain after this rule: if a customer has at least one type 0 order, leave out all of that customer's type 1 orders; customers with only type 1 orders keep them. For instance, customer 1 with two type 0 orders, customer 2 with one of each type, customer 3 with one type 1 order and customer 4 with one type 0 and two type 1 orders keep order ids 1, 2, 11, 21, 22. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nType 0 orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always kept', 'next' => 's2'],
                ['label' => 'Dropped when the customer also has type 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule only removes type 1 orders.\nStep back to when you dropped type 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A customer with only type 1 orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop them', 'next' => 'wrong_b'],
                ['label' => 'Keep them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the sample, customer 3 keeps order 21.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A customer with both types?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep type 0, drop type 1', 'next' => 'success'],
                ['label' => 'Keep both', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In the sample, customer 2 loses order 12.\nStep back to when you kept both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One WHERE with NOT IN. Constructed check → 1, 2, 11, 21, 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
