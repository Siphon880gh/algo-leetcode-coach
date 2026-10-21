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
            'message' => "Problem: A table TeamPoints lists each team_id, its name and its points, and a table PointsChange gives each team_id a points_change. Teams are ranked by points, highest first, with ties broken by name in alphabetical order. Return each team_id and name with rank_diff, its rank before the change minus its rank after. For instance, A 10, B 8, C 8 with changes −5, 0, +3 → A −2, B 0, C 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRanking order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Points descending, then name', 'next' => 's2'],
                ['label' => 'Points descending only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. B and C tie at 8 in the constructed example, so their order would be arbitrary.\nStep back to when you dropped the name tie-break.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "rank_diff?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'New rank − old rank', 'next' => 'wrong_b'],
                ['label' => 'Old rank − new rank', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A would get 2 instead of −2.\nStep back to when you reversed the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "New points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'points + points_change', 'next' => 'success'],
                ['label' => 'points_change alone', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The change is added to the old total.\nStep back to when you ranked the change alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → (1, A, −2), (2, B, 0), (3, C, 2).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
