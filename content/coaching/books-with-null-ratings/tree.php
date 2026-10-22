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
            'message' => "Problem: One table lists books with an optional rating. Return the books that have not been rated yet. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rating IS NULL', 'next' => 's2'],
                ['label' => 'rating = NULL', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That returns no rows (checked in SQLite).\nStep back to when you used = NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Or?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'NOT rating > 0', 'next' => 'wrong_b'],
                ['label' => 'Keep IS NULL', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. NOT NULL > 0 is still NULL: the guide’s check returns no rows.\nStep back to when you used NOT.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → ids 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
