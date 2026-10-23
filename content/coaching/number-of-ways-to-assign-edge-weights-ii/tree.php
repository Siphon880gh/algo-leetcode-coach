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
            'message' => "Read the problem statement above.\nPath length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'depth[u] + depth[v] − 2 · depth[lca]', 'next' => 's2'],
                ['label' => '|depth[u] − depth[v]|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [2, 1, 1] instead of [2, 1, 4].\nStep back to when you subtracted depths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "L = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 way', 'next' => 'wrong_b'],
                ['label' => '0 ways (the cost 0 is even)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 1] instead of [0, 1].\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [0, 1], [2, 1, 4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
