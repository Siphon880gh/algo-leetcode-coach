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
            'message' => "Read the problem statement above.\nFilter only on primary_flag = Y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, single-department employees are flagged N', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Employees 1 and 3 would disappear.\nStep back to when you filtered only on Y.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find single-department employees?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE primary_flag = N', 'next' => 'wrong_b'],
                ['label' => 'GROUP BY employee_id HAVING COUNT(*) = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Multi-department employees also have N rows.\nStep back to when you used the N flag.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR (or UNION)', 'next' => 'success'],
                ['label' => 'AND', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A row qualifies by either rule.\nStep back to when you used AND.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Example → (1,1), (2,1), (3,3), (4,3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
