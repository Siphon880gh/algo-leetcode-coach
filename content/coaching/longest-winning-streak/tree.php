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
            'message' => "Problem: A table Matches records each player_id, a match_day and a result (Win, Draw or Lose). For every player, return the length of the longest run of consecutive matches that are all wins, or 0 if they never won. For instance, player 1 with Win, Win, Win, Draw, Win → 3; a player with only losses → 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStreak length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Size of the largest run of consecutive wins', 'next' => 's2'],
                ['label' => 'Total number of wins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Player 1 in the constructed example → 4 instead of 3; the draw breaks the run.\nStep back to when you counted all wins.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Row numbers ordered by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No order', 'next' => 'wrong_b'],
                ['label' => 'match_day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without day order, consecutive matches are not adjacent numbers.\nStep back to when you left the order out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Players with no wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN from all players, COALESCE to 0', 'next' => 'success'],
                ['label' => 'Only players found in the win groups', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Player 2 would vanish instead of showing 0.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → (1, 3), (2, 0), (3, 1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
