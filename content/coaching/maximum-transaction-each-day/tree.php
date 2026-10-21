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
            'message' => "Problem: A transactions table lists each transaction's id, a date-time and an amount. Report the ids of the transactions with the largest amount on their calendar day, including all ties, in the order the statement specifies. For instance, transactions (1, day 1 10:00, 50), (2, day 1 18:00, 50), (3, day 1 12:00, 20) and (4, day 2 09:00, 30) give 1, 2 and 4. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPartition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The calendar date', 'next' => 's2'],
                ['label' => 'The full timestamp', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every transaction would be its own group.\nStep back to when you used the timestamp.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ranking function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER', 'next' => 'wrong_b'],
                ['label' => 'RANK or DENSE_RANK', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ROW_NUMBER drops tied maxima.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As the statement specifies', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output order is part of the expected result.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 1, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
