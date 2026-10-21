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
            'message' => "Problem: Customers, products (prices), and orders (product, quantity, date) are given. Report customers whose spending reached the statement's amount in each of the months it names. For instance, meeting the bar in only one month is not enough. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter months in WHERE to one month?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: both in HAVING', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You need both months per customer.\nStep back to when you filtered one month.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spending formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'quantity', 'next' => 'wrong_b'],
                ['label' => 'price × quantity', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Spending is money, not units.\nStep back to when you summed quantity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine month conditions with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AND', 'next' => 'success'],
                ['label' => 'OR', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each month must meet the bar.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One grouped query with two conditional sums.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
