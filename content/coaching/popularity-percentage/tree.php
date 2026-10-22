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
            'message' => "Problem: A friends table lists friendships as pairs of users, each pair once. For every user, report their popularity: the percentage of all users on the platform who are their friends, rounded and ordered as the statement says. Who counts as a user on the platform and the exact columns and output names are in the official statement. For instance, with friendships 1–2, 1–3 and 2–4 among four users, user 1 → 50.00 and user 3 → 25.00. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount friends from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both columns, via UNION ALL', 'next' => 's2'],
                ['label' => 'Only the first column', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Users who appear only second vanish; in SQLite the example → user 1 100.0 and user 3 missing, instead of 50.00 and 25.00.\nStep back to when you counted one column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute the percentage how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count / total · 100 in integers', 'next' => 'wrong_b'],
                ['label' => '100.0 · count / total', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Integer division truncates first; in SQLite every user → 0.\nStep back to when you divided integers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The example → 50.00, 50.00, 25.00, 25.00 for users 1–4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
