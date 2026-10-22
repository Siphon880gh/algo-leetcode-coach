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
            'message' => "Problem: One table lists products with a category and a price; another lists a percentage discount for some categories. Return each product’s price after its category’s discount, keeping the full price when the category has no discount. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check product 4 disappears.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Missing discount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it as NULL', 'next' => 'wrong_b'],
                ['label' => 'COALESCE to 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Product 4’s price comes out NULL (checked in SQLite).\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → 900, 40, 1080, 500.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
