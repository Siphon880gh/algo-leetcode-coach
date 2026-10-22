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
            'message' => "Read the problem statement above.\nn reaches 10^5. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk once, reusing finished nodes', 'next' => 's2'],
                ['label' => 'Walk from every node separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A long chain into a cycle costs about n²/2 = 5 · 10^9 steps.\nStep back to when you walked from every node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A node off the cycle gets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans[next]', 'next' => 'wrong_b'],
                ['label' => 'ans[next] + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It visits itself too; example 1 → node 3 gets 3 instead of 4.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3, 3, 3, 4], [5, 5, 5, 5, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
