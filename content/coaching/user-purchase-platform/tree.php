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
            'message' => "Problem: A spending table records, per user and date, the platform used (mobile or desktop) and the amount. For each date, report the total amount and number of users who used only mobile, only desktop, or both that day, with every date showing all three groups (zeros included). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by platform directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a user on both would count twice', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Both-platform users belong to one group.\nStep back to when you grouped by platform.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you label a user-day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first platform seen', 'next' => 'wrong_b'],
                ['label' => 'both if two distinct platforms, else the one used', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That misses users on both.\nStep back to when you took the first one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A date has no both-platform users. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A row with zeros', 'next' => 'success'],
                ['label' => 'No row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every date must show all three groups.\nStep back to when you dropped the row.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. Three rows per date with totals and user counts.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
