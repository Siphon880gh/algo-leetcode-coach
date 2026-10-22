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
            'message' => "Problem: One table lists cities with their state. For each state with enough cities and at least one city starting with the same letter as the state, return the state, its cities joined into one string, and how many cities share the state’s first letter, ordered as the statement specifies. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilters (as assumed)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Enough cities and at least one letter match', 'next' => 's2'],
                ['label' => 'Enough cities only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s check also returns Ohio with 0 matches.\nStep back to when you dropped the letter filter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter counts with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE', 'next' => 'wrong_b'],
                ['label' => 'HAVING', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. WHERE cannot use COUNT; SQLite rejects it as misuse of an aggregate.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → Maine 2, Texas 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
