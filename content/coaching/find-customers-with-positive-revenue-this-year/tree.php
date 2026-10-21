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
            'message' => "Problem: A customers table records each customer's revenue per year. Report the customers whose revenue in the specific year the statement names is strictly positive, with the column name it specifies. For instance, with the year 2021, a customer with 30 that year is reported, while customers with −50 or 0 that year, or revenue only in other years, are not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRevenue condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater than 0', 'next' => 's2'],
                ['label' => '≥ 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Zero revenue is not positive.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Year condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any year', 'next' => 'wrong_b'],
                ['label' => 'Only the named year', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Revenue in other years does not count.\nStep back to when you dropped the year.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aggregate needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, one row per customer-year', 'next' => 'success'],
                ['label' => 'SUM per customer', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The filter is on that year's row.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Constructed check → customer 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
