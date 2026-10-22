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
            'message' => "Problem: A users table lists users and a rides table records each ride’s user and distance. Report every user with their total distance, using 0 for users with no rides, ordered as the statement says. The exact columns and output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin users to rides with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A left join', 'next' => 's2'],
                ['label' => 'An inner join', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Users without rides vanish; in SQLite the check drops user 2.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The sum for a user with no rides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM(distance)', 'next' => 'wrong_b'],
                ['label' => 'COALESCE(SUM(distance), 0)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is NULL; in SQLite user 2 shows NULL instead of 0.\nStep back to when you left out COALESCE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → 15, 0, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
