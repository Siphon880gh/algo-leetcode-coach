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
            'message' => "Problem: An activity table has one row per player per login date, with the device used and the number of games played. Report each player with the device of their first login. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First find each player\'s min date, then fetch that row', 'next' => 's2'],
                ['label' => 'SELECT player_id, device_id, MIN(event_date) GROUP BY player_id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. device_id next to MIN(event_date) in a GROUP BY is not from the min row.\nStep back to when you grouped and selected device_id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subquery: player_id, MIN(event_date).\nHow do you match it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE event_date IN (SELECT MIN(event_date) …)', 'next' => 'wrong_b'],
                ['label' => 'WHERE (player_id, event_date) IN (subquery)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching only the date can pick another player's row on the same day.\nStep back to when you matched on the date alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The key (player_id, event_date) is unique, so each player matches one row. Window: RANK() OVER (PARTITION BY player_id ORDER BY event_date) = 1.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Tuple IN with the min-date subquery, or partitioned rank', 'next' => 'success'],
                ['label' => 'RANK() OVER (ORDER BY event_date) without a partition', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without PARTITION BY, the rank runs over the whole table; only the overall first row gets rank 1.\nStep back to when you dropped PARTITION BY.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Find the first date per player, then its row: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
