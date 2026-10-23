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
            'message' => "Read the problem statement above.\nWhich three reviews?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The newest three', 'next' => 's2'],
                ['label' => 'The oldest three', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. No rows instead of 3 on the example.\nStep back to when you sorted oldest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Improving means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never decreasing', 'next' => 'wrong_b'],
                ['label' => 'Strictly increasing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. David Wilson is added with 0.\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Bob Smith 3, Alice Johnson 2, Carol Davis 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
