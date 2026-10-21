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
            'message' => "Problem: A friends table records each person's activity. Report the activities whose participant count is neither the largest nor the smallest among activities. For instance, counts 3, 2, and 1 leave only the activity with 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDrop extremes with LIMIT?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare with MAX and MIN', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ties mean several activities can share an extreme.\nStep back to when you used LIMIT.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare counts against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total rows', 'next' => 'wrong_b'],
                ['label' => 'Per-activity counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The extremes are among activity counts.\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two activities tie at the max count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exclude both', 'next' => 'success'],
                ['label' => 'Keep one of them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every activity at the max count is excluded.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One CTE with two comparisons.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
