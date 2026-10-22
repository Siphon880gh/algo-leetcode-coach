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
            'message' => "Problem: A salary table holds employee rows with names, a department and a yearly salary; old rows with outdated salaries were never removed, so an employee can appear several times. Salaries only increase over the years, so each employee’s current salary is their largest one. Return each employee’s current row, ordered as the statement says. The exact columns and output format are in the official statement. For instance, an employee with rows at 99000 and 110000 → the 110000 row. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow to keep one row per employee?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max per employee, then join back', 'next' => 's2'],
                ['label' => 'GROUP BY every column, salary included', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every row is its own group; the constructed check → 5 rows instead of 3.\nStep back to when you grouped by everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Salaries stored as text?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take MAX of the text', 'next' => 'wrong_b'],
                ['label' => 'Cast to a number before MAX', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Text compares digit by digit; employee 1 → 99000 instead of 110000.\nStep back to when you compared text.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → 110000, 72000, 50000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
