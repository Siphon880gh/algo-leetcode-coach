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
            'message' => "Problem: Using the Hopper Company ride tables, report for each three-month window of 2020 (starting January through October) the average monthly ride distance and ride duration over that window, rounded as the statement specifies. For instance, monthly distances 30, 0, 60 for January to March give a January window average of 30. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nEmpty months?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count as 0 via the calendar', 'next' => 's2'],
                ['label' => 'Skip them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Skipping shrinks the window and inflates the average.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average of what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All rides in the window', 'next' => 'wrong_b'],
                ['label' => 'The three monthly totals', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The report averages per month.\nStep back to when you averaged rides.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which months to output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … 10', 'next' => 'success'],
                ['label' => '1 … 12', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Windows starting in 11 or 12 run past 2020.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: 30, 0, 60 → 30.00 for January.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
