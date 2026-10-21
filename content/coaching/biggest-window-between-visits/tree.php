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
            'message' => "Problem: Given a user-visits table (user id, visit date), report for each user the largest number of days between consecutive visits, counting the gap from the last visit to a fixed end date the statement gives, ordered as the statement specifies. For instance, with visits on 2020-11-28 and 2020-12-03 and an end date of 2020-12-31, the windows are 5 and 28, so the answer is 28. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nLast visit's window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to the end date', 'next' => 's2'],
                ['label' => 'Ignored', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The final gap counts.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next visit via?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(visit_date)', 'next' => 'wrong_b'],
                ['label' => 'LEAD ordered by date per user', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need each consecutive pair.\nStep back to when you used MAX.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX of the gaps', 'next' => 'success'],
                ['label' => 'AVG of the gaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The biggest window is asked.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
