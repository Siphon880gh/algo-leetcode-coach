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
            'message' => "Read the problem statement above.\nJoin type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN Transactions', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inner join drops the visits you need.\nStep back to when you used INNER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE t.amount = 0', 'next' => 'wrong_b'],
                ['label' => 'WHERE t.transaction_id IS NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No transaction means no row, not a zero amount.\nStep back to when you checked amount.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'customer_id, COUNT(*) AS count_no_trans', 'next' => 'success'],
                ['label' => 'One row per visit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The report counts visits per customer.\nStep back to when you listed visits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. In the example: 54 → 2, 30 → 1, 96 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
