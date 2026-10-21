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
            'message' => "Read the problem statement above.\nWhich side is the manager?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm.employee_id = e.reports_to', 'next' => 's2'],
                ['label' => 'e.employee_id = m.reports_to', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That reverses the relationship and groups employees by their own boss.\nStep back to when you reversed the join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN from managers', 'next' => 'wrong_b'],
                ['label' => 'INNER JOIN, so only real managers remain', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A left join lists employees with no reports at all.\nStep back to when you used a left join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Average age?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(AVG(e.age))', 'next' => 'success'],
                ['label' => 'AVG(m.age)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. We average the reports, not the manager, and must round.\nStep back to when you used the manager's age.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Example 1 → (9, Hercy, 2, 39).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
