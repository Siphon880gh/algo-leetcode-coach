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
            'message' => "Problem: One table holds each team’s season stats: wins, draws, losses, and goals for and against. For each team and season, return points, goal difference and the position within the season, ranked by points, then goal difference, then name, as the statement specifies. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER by points, goal difference, name', 'next' => 's2'],
                ['label' => 'RANK by points only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check Ash, Elm and Fir all get position 1.\nStep back to when you ranked by points only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Points (as assumed)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'wins + draws', 'next' => 'wrong_b'],
                ['label' => '3 · wins + draws', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check Fir moves from 3 to 1 (checked in SQLite).\nStep back to when you counted wins like draws.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → Ash 1, Elm 2, Fir 3, Oak 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
