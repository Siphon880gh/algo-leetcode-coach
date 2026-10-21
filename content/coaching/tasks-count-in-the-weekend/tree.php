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
            'message' => "Problem: A table Tasks records task_id, assignee_id and submit_date. Return one row with two counts: the number of tasks submitted on a weekend day (Saturday or Sunday) and the number submitted on a working day. For instance, six tasks spread over one Monday-to-Sunday week, three of them on the Saturday and Sunday → 3 and 3. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWeekend test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WEEKDAY(submit_date) >= 5', 'next' => 's2'],
                ['label' => 'DAYOFWEEK(submit_date) >= 5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. DAYOFWEEK runs from 1 for Sunday, so that counts Thursday to Saturday; the constructed week → 1 instead of 3.\nStep back to when you used DAYOFWEEK.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Aggregate the condition how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(condition)', 'next' => 'wrong_b'],
                ['label' => 'SUM(condition)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. COUNT counts every non-null row, false included; → 6 instead of 3.\nStep back to when you used COUNT.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Grouping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None: one row for the table', 'next' => 'success'],
                ['label' => 'GROUP BY assignee_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The constructed week has five assignees → 5 rows instead of 1.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
