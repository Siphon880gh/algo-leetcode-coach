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
            'message' => "Read the problem statement above.\nCount rows per day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: COUNT(DISTINCT user_id)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One user has many activities a day.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window ending on the statement's date. Start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '30 days earlier, inclusive', 'next' => 'wrong_b'],
                ['label' => '29 days earlier, inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is 31 days.\nStep back to when you subtracted 30.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Days with no activity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them out', 'next' => 'success'],
                ['label' => 'Show them with 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only days with an active user are listed.\nStep back to when you filled zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Columns day and active_users, one row per active day.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
