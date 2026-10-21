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
            'message' => "Problem: A transactions table records, for each account, a day, a type (Deposit or Withdraw) and an amount. Report each account's balance after every transaction, in the order the statement asks for. For instance, an account depositing 2000, withdrawing 1000 and depositing 3000 on three successive days shows balances 2000, 1000, 4000; another depositing 7000 and then withdrawing 7000 shows 7000, 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nA withdrawal row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add −amount', 'next' => 's2'],
                ['label' => 'Add amount', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Withdrawals lower the balance; 2000 then a 1000 withdrawal is 1000, not 3000.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "PARTITION BY?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'The account', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without it the running sum mixes accounts.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "ORDER BY inside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The day', 'next' => 'success'],
                ['label' => 'No ORDER BY', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without an order the window covers the whole partition, so every row shows the final balance.\nStep back to when you dropped the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One window query. Constructed check → 2000, 1000, 4000 and 7000, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
