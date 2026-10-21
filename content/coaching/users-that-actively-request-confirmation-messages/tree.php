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
            'message' => "Problem: A confirmations table records each confirmation request with a user id, a timestamp and an action (a signups table also exists). Report the ids of users who requested two confirmation messages within 24 hours of each other (boundary handling as the statement specifies), using the column name it gives. For instance, user 3 requesting at 03:30 and 15:00 on the same day qualifies, as does user 2 requesting at 00:00 and 23:00; user 7 requesting two days apart does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCompare times how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference in seconds against 86400', 'next' => 's2'],
                ['label' => 'Compare calendar dates', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 23:00 and 01:00 the next day are two hours apart.\nStep back to when you compared dates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same user only', 'next' => 'wrong_b'],
                ['label' => 'Same user, b later than a', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each row would pair with itself.\nStep back to when you allowed equal rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SELECT DISTINCT', 'next' => 'success'],
                ['label' => 'One row per qualifying pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each user should appear once.\nStep back to when you listed pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → users 2 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
