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
            'message' => "Read the problem statement above.\nAn edge weight changes. Which nodes move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node in the child’s subtree', 'next' => 's2'],
                ['label' => 'Only the child node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. edges [[1, 2, 1], [2, 3, 1]], update (1, 2) to 5, query 3 → 1 instead of 6.\nStep back to when you changed only the child.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Amount to add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The new weight itself', 'next' => 'wrong_b'],
                ['label' => 'New weight − current weight', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [7, 11] instead of [7, 4].\nStep back to when you added the new weight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [7, 4], [0, 4, 2, 7], [8, 3, 2, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
