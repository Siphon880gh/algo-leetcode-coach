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
            'message' => "Read the problem statement above.\nWhich days count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Days with exactly one action', 'next' => 's2'],
                ['label' => 'Every action row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A made-up user with login on five straight days plus a click on day 3 (run in SQLite) is kept instead of dropped.\nStep back to when you skipped the filter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minimum streak?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'More than 5 days', 'next' => 'wrong_b'],
                ['label' => 'At least 5 days', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example (run in SQLite) → user 1’s 5-day login streak is dropped instead of kept.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → user 3 view 7, user 1 login 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
