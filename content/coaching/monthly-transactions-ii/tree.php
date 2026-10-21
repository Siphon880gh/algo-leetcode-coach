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
            'message' => "Problem: A transactions table records country, state, amount, and date, and a chargebacks table records chargebacks against transactions with their own date. For each month and country, report the count and amount of approved transactions and of chargebacks, a chargeback counting in its own month. The official statement lists the exact columns and which rows to keep. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nChargeback month comes from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The chargeback\'s own date', 'next' => 's2'],
                ['label' => 'The original transaction date', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A chargeback belongs to the month it happened.\nStep back to when you used the transaction date.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Country and amount of a chargeback?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them NULL', 'next' => 'wrong_b'],
                ['label' => 'Join back to its transaction', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The chargebacks table refers to a transaction for those.\nStep back to when you left them NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "UNION or UNION ALL?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 'success'],
                ['label' => 'UNION', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Identical event rows would merge.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + c). One row per month and country with four totals.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
