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
                ['label' => 'At least 5 courses and average rating ≥ 4', 'next' => 's2'],
                ['label' => 'Every user', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. React Basics → Node.js is counted 3 times instead of 2.\nStep back to when you skipped the filter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Course count test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) > 5', 'next' => 'wrong_b'],
                ['label' => 'COUNT(*) >= 5', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. User 2 drops out, so Node.js → Docker is counted once instead of twice.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Node.js → Docker 2, React Basics → Node.js 2, then five pairs with 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
