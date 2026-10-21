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
            'message' => "Problem: A product table names products, and a sales table gives, per product, a sales period and the average daily sales. Report each product's total for each calendar year the period touches, within the years the statement covers. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDays in a year's share?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overlap of the period with that year', 'next' => 's2'],
                ['label' => 'Whole period length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each year gets only its own days.\nStep back to when you used the whole period.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Day count formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DATEDIFF(end, start)', 'next' => 'wrong_b'],
                ['label' => 'DATEDIFF(end, start) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both ends are included.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Year rows from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A recursive CTE or year list', 'next' => 'success'],
                ['label' => 'Only the start year', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Periods can span several years.\nStep back to when you used one year.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, December 30 to January 2 at 10 per day → 20 and 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
