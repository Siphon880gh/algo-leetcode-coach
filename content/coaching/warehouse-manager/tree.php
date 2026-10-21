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
            'message' => "Problem: Given a warehouse table (warehouse name, product, units) and a product table (dimensions per product), report the total cubic volume stored in each warehouse. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nVolume of one row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'units × width × length × height', 'next' => 's2'],
                ['label' => 'width × length × height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each unit takes that volume.\nStep back to when you dropped units.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cross join', 'next' => 'wrong_b'],
                ['label' => 'Inner join on the product id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rows must match their own product.\nStep back to when you cross joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Grouping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY warehouse name', 'next' => 'success'],
                ['label' => 'GROUP BY product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The report is per warehouse.\nStep back to when you grouped by product.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One aggregate per warehouse, as the statement specifies.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
