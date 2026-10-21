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
            'message' => "Read the problem statement above.\nWhat do you group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'customer_id', 'next' => 's2'],
                ['label' => 'product_key', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The question is about each customer.\nStep back to when you grouped by product.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT product_key)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeat purchases would inflate it.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare it with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(SELECT COUNT(*) FROM Product)', 'next' => 'success'],
                ['label' => 'A hard-coded number', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The product list can change.\nStep back to when you hard-coded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. With the statement's example, the customers with ids 1 and 3 bought both products, so they are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
