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
            'message' => "Read the problem statement above.\nTie on quantity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Higher revenue, then category name', 'next' => 's2'],
                ['label' => 'Category name', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Summer → Fitness instead of Tech on the example.\nStep back to when you skipped revenue.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seasons?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Calendar quarters (Jan–Mar as Winter)', 'next' => 'wrong_b'],
                ['label' => 'Winter = Dec, Jan, Feb, and so on', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fall → Kitchen 6 instead of Apparel 10 on the example.\nStep back to when you used quarters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Fall Apparel, Spring Kitchen, Summer Tech, Winter Apparel.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
