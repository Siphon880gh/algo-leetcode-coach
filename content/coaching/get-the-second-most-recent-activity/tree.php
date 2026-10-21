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
            'message' => "Problem: A user activity table records each user's activities with start and end dates. For each user, report the second most recent activity, or the only one if the user has just one. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOrder for \"most recent\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start date descending', 'next' => 's2'],
                ['label' => 'Ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The latest start is the most recent.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rn = 2', 'next' => 'wrong_b'],
                ['label' => 'rn = 2 OR cnt = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Single-activity users would vanish.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Partition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'User', 'next' => 'success'],
                ['label' => 'Activity', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ranking is per user.\nStep back to when you partitioned by activity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, starts on days 1, 5, 9 → the day-5 activity.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
