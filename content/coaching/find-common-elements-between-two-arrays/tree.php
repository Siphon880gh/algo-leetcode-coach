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
            'message' => "Read the problem statement above.\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices', 'next' => 's2'],
                ['label' => 'Distinct common values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1, 1] instead of [2, 1].\nStep back to when you counted distinct values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Look up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same index in the other array', 'next' => 'wrong_b'],
                ['label' => 'Anywhere in the other array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [0, 0] instead of [3, 4].\nStep back to when you compared by index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [2, 1], [3, 4], [0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
