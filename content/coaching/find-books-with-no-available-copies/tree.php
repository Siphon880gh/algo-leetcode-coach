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
            'message' => "Read the problem statement above.\nOpen loan test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'return_date IS NULL', 'next' => 's2'],
                ['label' => 'return_date = NULL', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. No rows, since a comparison with NULL is never true.\nStep back to when you used =.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which records count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All records', 'next' => 'wrong_b'],
                ['label' => 'Only open loans', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 4 rows instead of 2 on the example.\nStep back to when you counted returned loans.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → The Great Gatsby 3, 1984 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
