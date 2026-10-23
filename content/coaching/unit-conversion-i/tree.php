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
            'message' => "Read the problem statement above.\nValue of a child?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parent’s value × factor', 'next' => 's2'],
                ['label' => 'The factor alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 2, 3] instead of [1, 2, 6].\nStep back to when you dropped the parent’s value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order conversions are listed', 'next' => 'wrong_b'],
                ['label' => 'BFS or DFS from unit 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1, 2, 3], [0, 1, 2]] → [1, 2, 0] instead of [1, 2, 6].\nStep back to when you followed input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 2, 6], [1, 2, 3, 8, 10, 6, 30, 24].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
