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
            'message' => "Problem: Three tables describe sellers (each with a favorite brand), orders (which seller sold which item) and items (each item’s brand). For each seller, count the distinct items they sold whose brand differs from their favorite brand, and report the seller or sellers with the highest count together with that count. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich sales to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Item brand differs from the favorite', 'next' => 's2'],
                ['label' => 'Item brand equals the favorite', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts the favorite brand instead; the guide’s constructed check → sellers 1 and 4 with 1 instead of sellers 1, 2, 3 with 2.\nStep back to when you kept equal brands.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT item)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A repeated sale counts twice; the guide’s constructed check → only seller 1 with 3.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Join, filter, count distinct, keep the maximum.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
