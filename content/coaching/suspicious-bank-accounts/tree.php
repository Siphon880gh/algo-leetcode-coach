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
            'message' => "Problem: An accounts table gives each account's maximum allowed monthly income; a transactions table lists transactions with an account, a type (incoming or outgoing, as the statement names them), an amount and a date. An account is suspicious if its total incoming amount exceeds its maximum in at least two consecutive calendar months. Report those accounts with the column name the statement specifies. For instance, with a limit of 100, totals of 150 in June and 120 in July flag the account, while 150 in June, 50 in July and 130 in August do not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich transactions to sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Incoming only', 'next' => 's2'],
                ['label' => 'All transactions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Outgoing amounts are not income.\nStep back to when you summed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next month of December?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Month number + 1', 'next' => 'wrong_b'],
                ['label' => 'January of the next year, via a month index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Month 13 never exists.\nStep back to when you added 1 to the month number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accounts with three over-limit months?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SELECT DISTINCT the account', 'next' => 'success'],
                ['label' => 'List every matching pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each account should appear once.\nStep back to when you dropped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → the first and third accounts.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
