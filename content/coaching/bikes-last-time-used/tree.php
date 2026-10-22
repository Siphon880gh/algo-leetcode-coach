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
            'message' => "Problem: A rides table records each ride with a bike identifier and the ride’s start and end times. For each bike, find the last time it was used, and order the bikes from most recently used to least. The exact columns and output names are in the official statement. For instance, a bike with rides ending at 10:00 and 15:30 on the same day was last used at 15:30. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nLast used means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX of the end time', 'next' => 's2'],
                ['label' => 'MAX of the start time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A long earlier ride can end later; rides 08:00–18:00 and 10:00–11:00 → 10:00 instead of 18:00 in SQLite.\nStep back to when you used the start time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'wrong_b'],
                ['label' => 'Most recent first, descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That lists the least recent first; the constructed check (run in SQLite) comes out reversed.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → bikes in order of their latest end time, newest first.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
