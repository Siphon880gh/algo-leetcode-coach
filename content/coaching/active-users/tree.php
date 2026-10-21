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
            'message' => "Problem: An accounts table names users; a logins table records login dates, possibly repeated. Report users with at least the statement's required number of consecutive login days, ordered by id. For instance, four straight days then a gap gives a longest streak of 4. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRepeat logins on a day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Deduplicate first', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Duplicates break the date minus row-number trick.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total login days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count all days', 'next' => 'wrong_b'],
                ['label' => 'No: consecutive only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Gaps reset the streak.\nStep back to when you counted all days.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several qualifying streaks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DISTINCT user', 'next' => 'success'],
                ['label' => 'One row per streak', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each user is reported once.\nStep back to when you listed streaks.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Gaps and islands, then DISTINCT ids joined to names.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
