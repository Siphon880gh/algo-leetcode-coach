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
            'message' => "Problem: Given a customers table of ids, report the ids between 1 and the maximum present id that are missing from the table, ordered as the statement specifies (typically ascending). For instance, ids {1, 4, 5} → 2 and 3. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nUpper bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(id) in the table', 'next' => 's2'],
                ['label' => 'A fixed large number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ids above the max are not missing.\nStep back to when you fixed a bound.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Series source?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent-id gaps only', 'next' => 'wrong_b'],
                ['label' => 'Recursive CTE', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Gaps give ranges, not each missing id.\nStep back to when you used gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep which numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those with no matching row', 'next' => 'success'],
                ['label' => 'Those with a matching row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Those are present ids.\nStep back to when you kept matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: {1, 4, 5} → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
