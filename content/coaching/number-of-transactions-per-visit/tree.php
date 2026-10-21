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
            'message' => "Problem: A visits table records a user's visit on a date, and a transactions table records each transaction by user and date. For every k from 0 to the largest number of transactions in one visit, report how many visits had exactly k transactions, including k values with no visits. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from which table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Visits, LEFT JOIN transactions', 'next' => 's2'],
                ['label' => 'Transactions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Visits with no transactions would vanish.\nStep back to when you started from transactions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k values with no visits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Omit them', 'next' => 'wrong_b'],
                ['label' => 'Report them with 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every k up to the max must appear.\nStep back to when you omitted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Generate 0..max how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recursive CTE', 'next' => 'success'],
                ['label' => 'Hard-code a list', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The max depends on the data.\nStep back to when you hard-coded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, visits with 0, 0, 1, 3 transactions → 0→2, 1→1, 2→0, 3→1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
