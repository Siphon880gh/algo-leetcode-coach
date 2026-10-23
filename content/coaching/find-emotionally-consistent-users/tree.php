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
            'message' => "Read the problem statement above.\nWhich users?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least 5 reactions', 'next' => 's2'],
                ['label' => 'Any number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A made-up user with 2 likes out of 2 (run in SQLite) is kept instead of dropped.\nStep back to when you skipped HAVING.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Share test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt · 5 > total · 3', 'next' => 'wrong_b'],
                ['label' => 'cnt · 5 ≥ total · 3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A made-up user with 3 sad out of 5 (run in SQLite) is dropped instead of kept.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → user 3 love 1.0, user 1 like 0.8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
