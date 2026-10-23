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
            'message' => "Read the problem statement above.\nPrompt-count test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) >= 3', 'next' => 's2'],
                ['label' => 'COUNT(*) > 3', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The example keeps only user 3 instead of users 3 and 1.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Above-average test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(tokens) >= AVG(tokens)', 'next' => 'wrong_b'],
                ['label' => 'MAX(tokens) > AVG(tokens)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A made-up user with three 100-token prompts (run in SQLite) is kept instead of dropped.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → user 3 (4, 237.5), user 1 (3, 133.33).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
