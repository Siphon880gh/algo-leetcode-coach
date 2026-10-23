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
            'message' => "Read the problem statement above.\nRows to join?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct (user, category) pairs', 'next' => 's2'],
                ['label' => 'Raw purchases', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Books–Clothing → 7 instead of 3 on the example.\nStep back to when you skipped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'category1 <> category2', 'next' => 'wrong_b'],
                ['label' => 'category1 < category2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each pair appears twice: 8 rows instead of 4 on the example.\nStep back to when you used <>.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → four pairs, each with 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
