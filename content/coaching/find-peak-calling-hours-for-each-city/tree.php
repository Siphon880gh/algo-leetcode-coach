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
            'message' => "Problem: A table logs calls, each with a time and a city. For each city, find the hour of the day with the most calls and report it with that number of calls; if several hours tie, report each of them. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup calls by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'City and the hour of the call time', 'next' => 's2'],
                ['label' => 'City and the full timestamp', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each call becomes its own group with count 1, so every call ties.\nStep back to when you grouped by the timestamp.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several hours tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep one (LIMIT 1)', 'next' => 'wrong_b'],
                ['label' => 'Keep all of them (RANK = 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sample’s city A ties at hours 8 and 9, and one would be lost.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → A at 9 and 8 (2 each), B at 22 (2).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
