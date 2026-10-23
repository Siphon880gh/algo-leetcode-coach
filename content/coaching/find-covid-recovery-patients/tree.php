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
            'message' => "Read the problem statement above.\nWhich negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one after the first positive', 'next' => 's2'],
                ['label' => 'The first negative at any date', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Carol Davis gets −21.\nStep back to when you dropped the date test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Patients with no later negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them (left join)', 'next' => 'wrong_b'],
                ['label' => 'Leave them out (inner join)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. David Wilson appears with no recovery time.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Alice Smith 10, Carol Davis 10, Bob Johnson 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
