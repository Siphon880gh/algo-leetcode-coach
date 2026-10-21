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
            'message' => "Problem: Users have starting credit; transactions record payer, payee, and amount. Report each user's final credit and whether it went negative, with labels as the statement specifies. For instance, credit 100, paying 150 and receiving 20 → −30, flagged. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nUsers without transactions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN with COALESCE 0', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. They must still appear.\nStep back to when you inner joined.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Payer's sign?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positive', 'next' => 'wrong_b'],
                ['label' => 'Negative', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paying reduces credit.\nStep back to when you added it.",
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
            'message' => "You are wrong. Equal transfers would merge.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One signed ledger joined back to users.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
