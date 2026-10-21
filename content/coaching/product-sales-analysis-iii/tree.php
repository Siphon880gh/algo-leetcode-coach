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
            'message' => "Read the problem statement above.\nHow do you find the first year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MIN(year) grouped by product_id', 'next' => 's2'],
                ['label' => 'The year of the smallest sale_id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ids need not follow years.\nStep back to when you used sale_id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A product has two sales in its first year. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One', 'next' => 'wrong_b'],
                ['label' => 'Both', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every first-year sale is returned.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you match rows to the first year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(product_id, year) IN the grouped subquery', 'next' => 'success'],
                ['label' => 'year IN (SELECT MIN(year) …) alone', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Another product's first year could match.\nStep back to when you matched year alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. With the statement's example, product 100 returns its 2008 sale and product 200 its 2011 sale.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
