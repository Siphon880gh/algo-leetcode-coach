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
            'message' => "Read the problem statement above.\nRecurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'J(i) = (J(i − 1) + k) mod i', 'next' => 's2'],
                ['label' => 'J(i) = J(i − 1) + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removing a friend shifts the start by k.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Base case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'J(1) = 1', 'next' => 'wrong_b'],
                ['label' => 'J(1) = 0 (0-based)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Use 0-based positions and add 1 at the end.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Follow-up O(1) space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterate the recurrence', 'next' => 'success'],
                ['label' => 'Simulate with a list', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The list needs O(n) space.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
