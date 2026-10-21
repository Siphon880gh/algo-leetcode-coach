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
            'message' => "Read the problem statement above.\nFilter WHERE sale_date in Q1, then list products?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a product that also sold later would slip through', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only products sold exclusively in Q1 count.\nStep back to when you filtered rows first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which HAVING?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) > 0', 'next' => 'wrong_b'],
                ['label' => 'MIN(sale_date) ≥ 2019-01-01 and MAX(sale_date) ≤ 2019-03-31', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That keeps every product with sales.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Products never sold. Include them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They were not sold in Q1 either.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. With the statement's example, only product 1 (S8) is returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
