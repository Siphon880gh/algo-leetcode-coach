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
            'message' => "Problem: A table lists users’ sessions, each with a start time and a type, either viewer or streamer. For users whose first session was as a viewer, report how many streaming sessions they have. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nUsers to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First session is a viewer', 'next' => 's2'],
                ['label' => 'Any viewer session', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The sample adds user 102, whose first session was a stream.\nStep back to when you accepted any viewer session.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All sessions', 'next' => 'wrong_b'],
                ['label' => 'Streamer sessions only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. User 101 → 3 instead of 2.\nStep back to when you counted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → 101 with 2, 103 with 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
