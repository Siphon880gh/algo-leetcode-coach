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
            'message' => "Problem: A salaries table records each employee’s name, department and salary. Report the absolute difference between the highest salary in one named department and the highest salary in another. The two departments, the columns and the output name are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCompare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each department’s MAX', 'next' => 's2'],
                ['label' => 'The overall MAX − MIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Other departments leak in; in SQLite the check → 800 instead of 50.\nStep back to when you used the whole table.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The plain difference', 'next' => 'wrong_b'],
                ['label' => 'ABS(difference)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The order can make it negative; in SQLite the check → −50.\nStep back to when you dropped ABS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → 50.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
