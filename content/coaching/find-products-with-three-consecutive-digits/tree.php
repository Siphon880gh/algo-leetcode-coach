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
            'message' => "Problem: One table lists products with an id and a name. Return the products whose name contains a run of exactly three digits in a row (a longer run does not count), ordered by id. Table, column and output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bounded on both sides', 'next' => 's2'],
                ['label' => '[0-9]{3} alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s check also returns 3 (Z45678).\nStep back to when you dropped the bounds.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A non-digit only', 'next' => 'wrong_b'],
                ['label' => 'A non-digit or the string edge', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The guide’s check → nothing instead of 1, 5, 6.\nStep back to when you dropped the edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total name length). The guide’s check → 1, 5, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
