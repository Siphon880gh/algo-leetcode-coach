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
            'message' => "Problem: A table Weather records city_id, day and degree, one row per city and day. For each city, report the day with the highest degree, the earliest such day on ties, together with that degree, ordered by city_id. For instance, a city whose highest reading of 37 occurs on two days reports the earlier day; a city with readings of −7 and −6 reports the −6 day. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER over degree DESC, day', 'next' => 's2'],
                ['label' => 'RANK over degree DESC', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The tied city gets two rows; the constructed table → 4 rows instead of 3.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Degree order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowest first', 'next' => 'wrong_b'],
                ['label' => 'Highest first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The −7 and −6 city reports −7 instead of −6.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Day tie-break?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest day', 'next' => 'success'],
                ['label' => 'Latest day', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The tied 37 city reports its later day.\nStep back to when you sorted day descending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (1, 2022-07-07, 24), (2, 2022-08-07, 37), (3, 2022-12-07, −6).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
