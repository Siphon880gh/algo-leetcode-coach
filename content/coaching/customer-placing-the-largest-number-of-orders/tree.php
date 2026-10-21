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
            'message' => "Read the problem statement above.\nWhat do you sort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) per customer_number, descending', 'next' => 's2'],
                ['label' => 'customer_number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The question is about who has the most orders, not the largest id.\nStep back to when you sorted by id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you take the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(COUNT(*)) in the same SELECT', 'next' => 'wrong_b'],
                ['label' => 'LIMIT 1: the data has a unique top customer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Aggregates cannot be nested in one SELECT.\nStep back to when you nested MAX.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Follow-up: several customers tie. Now what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK() OVER (ORDER BY COUNT(*) DESC) in a subquery, keep rank 1', 'next' => 'success'],
                ['label' => 'Keep LIMIT 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. LIMIT 1 keeps one of the tied customers and drops the rest.\nStep back to when you kept LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group, order by count, LIMIT 1, or RANK for ties: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
