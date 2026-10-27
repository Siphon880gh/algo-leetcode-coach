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
            'message' => "State:\nprices = [1, 2, 4]\ncash = 0\nhold = −∞\n\nAfter seeing price 1, what is hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1, from buying at 1', 'next' => 'mid'],
                ['label' => '1, as if there were already a profit', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBuying costs 1, so hold becomes −1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ncash = 0, hold = −1\nprice 2 arrives\nselling would make cash = hold + 2 = 1\n\nWhat is the new cash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'ask'],
                ['label' => '0, because you should never sell early', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nCash is the better of the old cash (0) and selling (hold + 2 = 1), so it becomes 1. You are allowed to sell.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => "State:\nprice 4 arrives\nyou sell from hold = −1\n\nWhat is the final cash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, from buying at 1 and selling at 4', 'next' => 'success'],
                ['label' => '4, the price itself', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nProfit is the sell price minus the buy price, which is 3, not the raw price.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Track two states: cash and hold.\n- One pass over the prices gives a profit of 3.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
