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
            'message' => "Problem: A traffic table logs user activities, logins among them, with dates, and may repeat rows. For each date in a recent window ending on a fixed reference date (the statement gives both; the window is roughly the last 90 days), report how many users had their first-ever login on that date, omitting dates with none. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter to the window before finding first logins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: first logins come from all history', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A returning user would look new.\nStep back to when you filtered first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which activity counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any activity', 'next' => 'wrong_b'],
                ['label' => 'Only logins', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The question is about first logins.\nStep back to when you used any activity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicate rows. A problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: MIN per user ignores them', 'next' => 'success'],
                ['label' => 'Yes, deduplicate first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Duplicates do not change a minimum.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. One row per date with its count of new users.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
