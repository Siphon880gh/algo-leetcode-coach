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
            'message' => "Problem: A purchases table records, for each purchase, a user, an item, a date and an amount, and it may contain duplicate rows. A user is active when they made a purchase within 7 days of another of their purchases. Return the active users in any order. Whether duplicate rows count as separate purchases, and the exact window boundary, are in the official statement. For instance, purchases on May 31 and June 7 count as within 7 days, while May 1 and May 20 do not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCompare which purchases?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each with the next one by date, using LEAD', 'next' => 's2'],
                ['label' => 'Each with the user’s first purchase', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A close pair can come later; purchases on May 1, 9 and 12 → not active instead of active in SQLite.\nStep back to when you compared with the first purchase.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every qualifying pair', 'next' => 'wrong_b'],
                ['label' => 'Distinct users', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A user with several close pairs repeats; purchases on May 1, 3 and 5 → listed twice instead of once.\nStep back to when you skipped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → users 1 and 2 active, user 3 not.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
