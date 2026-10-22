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
            'message' => "Problem: An orders table records, for each order, a customer, a date and a price. A customer qualifies when their total spending per year strictly increases every year from their first order year to their last, where a year in between with no orders counts as 0. Return the qualifying customers. For instance, a customer spending 100 in 2019, 150 in 2020 and 300 in 2021 qualifies; one spending 100 in 2019 and 300 in 2021 with nothing in 2020 does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nA year with no orders between two order years?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It counts as 0, so the customer fails', 'next' => 's2'],
                ['label' => 'Skip it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That year is a drop to 0; 100 in 2019 and 300 in 2021 would qualify instead of failing.\nStep back to when you skipped the gap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare a year with the one before using?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greater or equal', 'next' => 'wrong_b'],
                ['label' => 'Strictly greater', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 100 then 100 is not strictly increasing, yet it would qualify.\nStep back to when you allowed equal totals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass of LAG per customer. Constructed checks (run in SQLite): 100, 150, 300 qualifies; a gap year or a repeated total does not.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
