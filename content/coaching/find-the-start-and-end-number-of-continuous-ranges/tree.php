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
            'message' => "Problem: A logs table holds distinct integer ids. Report each maximal run of consecutive ids as its start and end, ordered by start. For instance, ids 1, 2, 3, 7, 8, 10 give 1–3, 7–8, and 10–10. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'id − ROW_NUMBER()', 'next' => 's2'],
                ['label' => 'id / 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Runs do not follow fixed buckets.\nStep back to when you bucketed ids.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per group, report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT', 'next' => 'wrong_b'],
                ['label' => 'MIN and MAX of the id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer is the run's start and end.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single-id run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start = end', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A lone id is still a range.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One window pass plus GROUP BY. Ids 1, 2, 3, 7, 8, 10 → 1–3, 7–8, 10–10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
