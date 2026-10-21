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
            'message' => "Problem: One table records salary payments per employee with a pay date; another maps employees to departments. For each pay month and department, compare the department's average pay that month with the company-wide average that month, labeling it higher, lower, or the same. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhat do you group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pay month as YYYY-MM, plus department for the department average', 'next' => 's2'],
                ['label' => 'The full pay_date', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The comparison is per month, and payments on different days of a month belong together.\nStep back to when you used the full date.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get the company's average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The average of the department averages', 'next' => 'wrong_b'],
                ['label' => 'AVG of all payments in that month', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Departments with different numbers of payments would be weighted equally.\nStep back to when you averaged the averages.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you produce the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE → \'higher\', \'lower\' or \'same\', one row per month and department', 'next' => 'success'],
                ['label' => 'Return the difference of the two averages', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The expected column holds the three labels.\nStep back to when you returned a number.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Window AVG per (month, department) and per month, then a CASE label with DISTINCT rows: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
