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
            'message' => "Problem: A flights table lists a departure airport, an arrival airport and a flight count for that route. An airport's traffic is the total number of flights that depart from it or arrive at it. Report every airport with the largest traffic. For instance, routes 1 → 2 (4 flights), 2 → 1 (5) and 2 → 4 (5) give traffic 9, 14 and 5, so the answer is airport 2; with routes 1 → 2 (4), 2 → 1 (5), 3 → 4 (5), 4 → 3 (4) and 5 → 6 (7), airports 1, 2, 3 and 4 tie at 9. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTraffic of an airport counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flights departing and arriving', 'next' => 's2'],
                ['label' => 'Departing flights only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In the second sample, departures alone pick airport 5, but airports 1 to 4 each have 9.\nStep back to when you dropped arrivals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the two sides with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION', 'next' => 'wrong_b'],
                ['label' => 'UNION ALL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. UNION removes duplicate rows: routes 1 → 2 and 2 → 1 of 3 flights each give airport 1 only 3 instead of 6.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several airports share the maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return all of them', 'next' => 'success'],
                ['label' => 'Return one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The second sample returns 1, 2, 3 and 4.\nStep back to when you returned one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 2, then 1, 2, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
