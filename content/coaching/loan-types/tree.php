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
            'message' => "Problem: A table lists loans, each with a user and a loan type. Report the users who have at least one loan of each of two loan types named in the statement. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per user, both types (HAVING)', 'next' => 's2'],
                ['label' => 'Rows of either type (WHERE … IN)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The sample → users 1, 2, 3, 4 instead of 1, 4.\nStep back to when you used IN.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test per user?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT type) ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'SUM(type = X) > 0 AND SUM(type = Y) > 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any two types pass; the sample adds user 3, who has Y and Z.\nStep back to when you counted distinct types.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → users 1 and 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
