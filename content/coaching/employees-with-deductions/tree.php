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
            'message' => "Problem: One table gives each employee the number of hours they must work, and another logs their work sessions with entry and exit times. Report the employees who worked less than required, which includes employees with no sessions at all; how each session’s length is rounded is set in the statement. For instance, an employee needing 12 hours who logged one session just under 12 hours is reported, and so is an employee who logged nothing. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin employees to the session totals how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN', 'next' => 's2'],
                ['label' => 'Inner join', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Employees with no sessions vanish; the constructed check reports one employee instead of two.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Employee with no sessions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare the NULL total as is', 'next' => 'wrong_b'],
                ['label' => 'COALESCE(total, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. NULL < x is not true, so they vanish again; one employee instead of two.\nStep back to when you left the NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare minutes with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Required hours · 60', 'next' => 'success'],
                ['label' => 'Required hours', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The units differ; the constructed check reports one employee instead of two.\nStep back to when you skipped the · 60.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (SQLite) → two employees reported.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
