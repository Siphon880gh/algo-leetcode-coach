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
            'message' => "Read the problem statement above.\nWhich join?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN Employee to Bonus', 'next' => 's2'],
                ['label' => 'INNER JOIN on empId', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An inner join drops the employees with no bonus, who must be in the answer.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bonus < 1000', 'next' => 'wrong_b'],
                ['label' => 'bonus < 1000 OR bonus IS NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. NULL < 1000 is unknown, not true, so those rows disappear.\nStep back to when you dropped the null test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What shows for an employee without a bonus?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'null, as the left join gives it', 'next' => 'success'],
                ['label' => 'IFNULL(bonus, 0)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The expected output shows null for them, not 0.\nStep back to when you replaced the null.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Left join, then bonus < 1000 OR bonus IS NULL: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
