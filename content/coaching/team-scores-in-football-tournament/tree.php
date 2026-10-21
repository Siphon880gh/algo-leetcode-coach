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
            'message' => "Problem: A teams table lists teams, and a matches table records host and guest teams with their goals. Wins and draws earn points as the statement specifies (typically 3 and 1). Report every team with its total points, including teams with none, sorted as the statement specifies (typically points descending, then team id). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin on host only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: host or guest', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Teams also earn points as guests.\nStep back to when you used host only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inner or left join?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inner', 'next' => 'wrong_b'],
                ['label' => 'Left: teams with no matches get 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every team must appear.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Draw scoring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both teams get the draw points', 'next' => 'success'],
                ['label' => 'Only the host', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A draw scores for both sides.\nStep back to when you scored the host only.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Every team with its points, in the required order.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
