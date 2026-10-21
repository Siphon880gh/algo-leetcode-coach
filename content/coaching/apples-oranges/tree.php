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
            'message' => "Problem: A sales table records, per date and fruit (apples or oranges), how many were sold. Report each date's apples minus oranges, ordered as the statement specifies. For instance, 10 apples and 8 oranges give 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSelf-join apples with oranges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Optional: conditional sum is simpler', 'next' => 's2'],
                ['label' => 'Required', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One grouped pass suffices.\nStep back to when you insisted on a join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'fruit', 'next' => 'wrong_b'],
                ['label' => 'sale_date', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The difference is per day.\nStep back to when you grouped by fruit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Oranges in the sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Negative', 'next' => 'success'],
                ['label' => 'Positive', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is a difference, not a total.\nStep back to when you added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. SUM(CASE apples THEN +n ELSE −n END) per day.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
