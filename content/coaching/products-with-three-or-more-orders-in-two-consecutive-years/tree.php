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
            'message' => "Problem: A table Orders records order_id, product_id, quantity and purchase_date. Return the ids of products that were ordered at least three times in each of two consecutive years, in any order. For instance, a product with three orders in 2020 and three in 2021 qualifies; one with three orders in 2022 and three in 2024 but none in 2023 does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPer product and year, count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Orders: COUNT(*)', 'next' => 's2'],
                ['label' => 'Units: SUM(quantity)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A product with one order of 5 units in each of two years would qualify.\nStep back to when you summed quantity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join condition on years?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any two different years', 'next' => 'wrong_b'],
                ['label' => 'b.yr = a.yr + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The product with qualifying years 2022 and 2024 would be included.\nStep back to when you allowed any pair of years.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SELECT DISTINCT', 'next' => 'success'],
                ['label' => 'Plain SELECT', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A product with three qualifying years in a row is listed twice.\nStep back to when you dropped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
