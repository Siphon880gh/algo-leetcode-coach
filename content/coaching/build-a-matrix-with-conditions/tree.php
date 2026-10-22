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
            'message' => "Read the problem statement above.\nOrderings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One topological order for rows, another for columns', 'next' => 's2'],
                ['label' => 'One order satisfying both sets of conditions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 wants 1 above 2 but 2 left of 1, so a shared order fails → [] instead of a matrix.\nStep back to when you merged the conditions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Kahn’s order has fewer than k numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append the missing numbers and continue', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2’s rows have the cycle 1 → 2 → 3 → 1, so any matrix breaks a condition.\nStep back to when you appended the rest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Place number v at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(row position, column position)', 'next' => 'success'],
                ['label' => '(row position, row position)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Column conditions are ignored; Example 1’s placement breaks 2 left of 1.\nStep back to when you used the diagonal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k² + n + m). Examples → a valid matrix such as [[0,0,1],[3,0,0],[0,2,0]], and [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
