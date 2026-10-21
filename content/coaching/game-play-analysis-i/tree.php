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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY player_id', 'next' => 's2'],
                ['label' => 'ORDER BY event_date LIMIT 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ORDER BY event_date LIMIT 1 returns a single row for the whole table.\nStep back to when you sorted and limited.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One row per player.\nWhich aggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(event_date)', 'next' => 'wrong_b'],
                ['label' => 'MIN(event_date) AS first_login', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. MAX gives the last login, not the first.\nStep back to when you used MAX.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "SELECT player_id, MIN(event_date) AS first_login FROM Activity GROUP BY player_id. Pandas: groupby().agg(min).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY player, MIN(date), nothing else', 'next' => 'success'],
                ['label' => 'Also select device_id in the same GROUP BY', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. device_id beside MIN is not tied to the min row; it can come from any row (or MySQL rejects it).\nStep back to when you added device_id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. GROUP BY with MIN. Player 1 → 2016-03-01.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
