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
            'message' => "Problem: A table Products has a product_id column and one price column per store, where the store columns are not known in advance and a null price means the product is not sold there. Write a procedure that returns rows (product_id, store, price) for every non-null price. For instance, product 1 with LC_Store 100 and Shop 110 and nulls elsewhere → (1, LC_Store, 100), (1, Shop, 110). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStore columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From information_schema.columns', 'next' => 's2'],
                ['label' => 'A fixed list in the query', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The store columns are not known in advance.\nStep back to when you fixed the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "product_id in the column list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep every column', 'next' => 'wrong_b'],
                ['label' => 'Exclude it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It becomes a fake store; the constructed example → 9 rows instead of 6.\nStep back to when you kept product_id.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Null prices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filter with IS NOT NULL', 'next' => 'success'],
                ['label' => 'Keep them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A null means the store does not sell it; the constructed example → 12 rows instead of 6.\nStep back to when you kept nulls.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → the six (product_id, store, price) rows.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
