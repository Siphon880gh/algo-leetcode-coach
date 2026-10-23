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
            'message' => "Read the problem statement above.\nCost to reach i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(cost[0 … i])', 'next' => 's2'],
                ['label' => 'cost[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [5, 3, 4, 1, 3, 2].\nStep back to when you paid directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minimum over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost[i … n − 1]', 'next' => 'wrong_b'],
                ['label' => 'cost[0 … i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 1, 1, 1, 2, 2].\nStep back to when you looked behind.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [5, 3, 3, 1, 1, 1], [1, 1, 1, 1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
