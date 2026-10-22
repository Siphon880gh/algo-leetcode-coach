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
            'message' => "Problem: A table records transactions, each with a product, an amount and a date. For each product and year, report that year’s total, the previous year’s total and the growth rate between them, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nLAG over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yearly totals', 'next' => 's2'],
                ['label' => 'Raw transactions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check product 1 has two 2019 rows, so 2020 compares with 50 instead of 150.\nStep back to when you used raw rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Divide by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current total', 'next' => 'wrong_b'],
                ['label' => 'The previous total', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check → 50.00, −25.00, −100.00.\nStep back to when you divided by the current total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → NULL, 100.00, −20.00; NULL, −50.00.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
