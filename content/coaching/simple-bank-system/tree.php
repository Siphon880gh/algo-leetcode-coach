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
            'message' => "Read the problem statement above.\nAccount numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid only in 1 … n; index is account − 1', 'next' => 's2'],
                ['label' => 'Use them directly as 0-based indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Accounts are numbered from 1, and n + 1 must be rejected.\nStep back to when you indexed directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transfer to an invalid account?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Debit the source anyway', 'next' => 'wrong_b'],
                ['label' => 'Fail without changing anything', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A failed transaction must leave every balance unchanged.\nStep back to when you debited first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Withdraw more than the balance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fail', 'next' => 'success'],
                ['label' => 'Allow a negative balance', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The amount must be at most the balance.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) each. Example → true, true, true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
