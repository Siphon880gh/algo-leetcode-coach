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
            'message' => "Problem: A table lists rows, each with an id and a drink that may be NULL. Replace each NULL drink with the most recent non-NULL drink above it, in the row order the statement uses, and return the rows in that order. For instance, rows (9, Tea), (6, NULL), (7, NULL), (3, Latte), (1, Mocha), (2, NULL) become Tea, Tea, Tea, Latte, Mocha, Mocha. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRow order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order the rows are given in', 'next' => 's2'],
                ['label' => 'ORDER BY id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The constructed rows fill from the wrong neighbours, giving Latte for ids 6 and 7.\nStep back to when you sorted by id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group label?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Running COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'Running COUNT(drink)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every row gets its own group, so NULLs stay NULL.\nStep back to when you counted every row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fill value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'FIRST_VALUE(drink) within the group', 'next' => 'success'],
                ['label' => 'LAG(drink) over the rows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A second NULL in a row stays NULL; id 7 in the constructed rows.\nStep back to when you used LAG.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (SQLite) → Tea, Tea, Tea, Latte, Mocha, Mocha.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
