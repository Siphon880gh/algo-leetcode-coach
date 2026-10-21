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
            'message' => "Problem: With an activity table that has one row per player per login date, a player's install date is their first login date. For each install date, report how many players installed that day and the day-1 retention: the share of those players who logged in again on the next day, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nInner join on the next day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a left join, so non-returning players still count as installs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Players who did not return would vanish from installs.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which count gives installs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows with a next-day match', 'next' => 'wrong_b'],
                ['label' => 'All rows per install date', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the number who came back.\nStep back to when you counted matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the first date come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MIN(event_date) per player', 'next' => 'success'],
                ['label' => 'The earliest date in the whole table', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each player has their own install date.\nStep back to when you used one date.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. One row per install date with installs and day-1 retention.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
