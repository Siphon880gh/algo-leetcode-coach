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
            'message' => "Problem: A players table gives each player's id and name; a championships table has one row per year with one column per tournament holding that year's winner id. Report each player who won at least one title with their total number of titles, with the column names the statement specifies. For instance, if player 1 won three of the four events in one year and one the next, and player 2 won the rest, both have 4 titles and a player with no wins is left out. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombine the columns with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 's2'],
                ['label' => 'UNION', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. UNION drops repeated winners and undercounts.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left join from players', 'next' => 'wrong_b'],
                ['label' => 'Inner join to players', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Players with no titles must not appear.\nStep back to when you used a left join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The player id and name', 'next' => 'success'],
                ['label' => 'The year', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Totals are per player.\nStep back to when you grouped by year.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass over the unpivoted rows. Constructed check → 4 and 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
