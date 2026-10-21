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
            'message' => "Problem: A table Purchases records purchase_id, user_id and purchase_date. Return the ids of users who made two purchases at most 7 days apart, in ascending order. For instance, a user buying on 2022-03-13 and 2022-03-20 qualifies; one buying twice on the same day qualifies; one with a single purchase does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGap test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≤ 7 days', 'next' => 's2'],
                ['label' => '< 7 days', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2022-03-13 and 2022-03-20 are exactly 7 days apart and qualify.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "LAG over what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY purchase_date only', 'next' => 'wrong_b'],
                ['label' => 'PARTITION BY user_id ORDER BY purchase_date', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The previous row could belong to another user.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DISTINCT user_id', 'next' => 'success'],
                ['label' => 'One row per close pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A user with several close pairs would repeat.\nStep back to when you skipped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed example → 2, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
