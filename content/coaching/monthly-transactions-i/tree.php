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
            'message' => "Read the problem statement above.\nFilter approved rows in WHERE?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use conditional aggregates', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The totals need declined rows too.\nStep back to when you filtered.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Month key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MONTH(trans_date)', 'next' => 'wrong_b'],
                ['label' => 'DATE_FORMAT(trans_date, \'%Y-%m\')', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Different years would merge.\nStep back to when you took the month number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count approved rows with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => "SUM(state = 'approved')", 'next' => 'success'],
                ['label' => "COUNT(state = 'approved')", 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. COUNT counts every non-NULL value, including 0.\nStep back to when you used COUNT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Columns month, country, trans_count, approved_count, trans_total_amount, approved_total_amount.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
