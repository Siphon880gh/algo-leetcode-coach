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
            'message' => "Problem: With the same per-player, per-date activity table, report for every row the player, the date, and the total games that player has played up to and including that date. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A running sum with a window function', 'next' => 's2'],
                ['label' => 'GROUP BY player_id with SUM(games_played)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. GROUP BY collapses each player into one row; every date needs its own row.\nStep back to when you grouped by player.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "SUM(games_played) OVER (…).\nWhat goes inside?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'PARTITION BY player_id only', 'next' => 'wrong_b'],
                ['label' => 'PARTITION BY player_id ORDER BY event_date', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without ORDER BY, the frame is the whole partition: every row gets the player's grand total.\nStep back to when you left out ORDER BY.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Default frame with ORDER BY runs from the first row to the current one. Self-join alternative: b.event_date <= a.event_date, GROUP BY a's keys.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Partition by player, order by date', 'next' => 'success'],
                ['label' => 'ORDER BY event_date only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without PARTITION BY, the sum runs across players.\nStep back to when you dropped PARTITION BY.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Partitioned, ordered window sum: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
