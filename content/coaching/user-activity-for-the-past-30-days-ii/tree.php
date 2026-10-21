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
            'message' => "Problem: An activity table logs user, session, date, and activity type. For the 30-day window ending on the date in the statement, report the average number of distinct sessions per user, rounded as the statement specifies, and 0 if nobody was active. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount activity rows per user?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: distinct sessions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A session holds many activities.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All users ever', 'next' => 'wrong_b'],
                ['label' => 'Users active in the window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only users in the window count.\nStep back to when you used everyone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Nobody was active. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => 'NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Wrap the average with IFNULL(…, 0).\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). One rounded average with a 0 fallback.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
