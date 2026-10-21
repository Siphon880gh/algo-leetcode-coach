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
            'message' => "Read the problem statement above.\nWhere does the balance filter go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING SUM(amount) > 10000', 'next' => 's2'],
                ['label' => 'WHERE amount > 10000', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The condition is on the total, not a row.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Name only', 'next' => 'wrong_b'],
                ['label' => 'The account (with name)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two users could share a name.\nStep back to when you grouped by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'name, balance', 'next' => 'success'],
                ['label' => 'account, amount', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The result shows name and summed balance.\nStep back to when you chose columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. In the example only Alice → 11000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
