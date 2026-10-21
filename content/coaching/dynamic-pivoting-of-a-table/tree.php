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
            'message' => "Problem: A table Products has columns product_id, store and price, where each (product_id, store) pair is unique and the set of stores is not known in advance. Write a procedure that returns one row per product with one column per store, columns ordered by store name, holding that product’s price in the store or null if it is not sold there. For instance, products sold at Shop and LC_Store, at Nozama and Souq, and at Shop and Souq → columns LC_Store, Nozama, Shop, Souq with nulls where missing. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStore columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Generate from the distinct store values', 'next' => 's2'],
                ['label' => 'Write the store names into the query', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The stores are not known in advance; a new store would be missing.\nStep back to when you hard-coded the names.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One row per product?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE expressions without grouping', 'next' => 'wrong_b'],
                ['label' => 'GROUP BY product_id with MAX(CASE …)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each (product, store) row stays separate; the constructed example → 6 rows instead of 3.\nStep back to when you skipped the grouping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Run the generated text?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'PREPARE and EXECUTE', 'next' => 'success'],
                ['label' => 'SELECT @sql', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That returns the query text, not the pivoted table.\nStep back to when you selected the variable.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → three rows with columns LC_Store, Nozama, Shop, Souq.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
