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
            'message' => "Read the problem statement above.\nLast event is cancel?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exclude the user', 'next' => 's2'],
                ['label' => 'Keep the user', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 504 is added.\nStep back to when you kept cancelled users.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Days as subscriber?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First event to the latest date in the table', 'next' => 'wrong_b'],
                ['label' => 'The user’s first to last event', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 506 is added (70 days instead of 50).\nStep back to when you used the table’s last date.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → 501 (79 days), 502 (70 days).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
