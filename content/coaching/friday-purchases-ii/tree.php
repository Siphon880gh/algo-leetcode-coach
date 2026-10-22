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
            'message' => "Problem: Same purchases table as Friday Purchases I. Now report every Friday of the month, with its week of the month, the date and the total spent, using 0 for a Friday with no purchases. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFridays from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A generated calendar', 'next' => 's2'],
                ['label' => 'Dates present in the table', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Fridays with no purchases vanish; the sample loses the 8th and 22nd.\nStep back to when you used table dates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty Friday’s total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM alone', 'next' => 'wrong_b'],
                ['label' => 'COALESCE(SUM, 0)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. SUM over no rows is NULL, not 0.\nStep back to when you dropped COALESCE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → 150, 0, 30, 0, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
