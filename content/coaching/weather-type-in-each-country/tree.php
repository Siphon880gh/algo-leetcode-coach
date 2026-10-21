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
            'message' => "Problem: A countries table maps ids to names, and a weather table records a weather_state per country per day. For the month the statement names, classify each country by its average weather_state into the statement's labels: cold up to one cutoff, hot from a higher cutoff, warm otherwise. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter the month where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE on the day', 'next' => 's2'],
                ['label' => 'After grouping', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Other days would skew the average first.\nStep back to when you filtered late.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Classify with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE on each day', 'next' => 'wrong_b'],
                ['label' => 'CASE on AVG(weather_state)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The label belongs to the average.\nStep back to when you classified days.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Country', 'next' => 'success'],
                ['label' => 'Day', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One row per country is expected.\nStep back to when you grouped by day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, with cutoffs 15 and 25, daily states 10 and 20 average 15 → cold.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
