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
            'message' => "Read the problem statement above.\nCount gcd-g pairs how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiples of g, minus exact counts of 2g, 3g, …', 'next' => 's2'],
                ['label' => 'List every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. About 5 · 10^9 pairs for n = 10^5.\nStep back to when you listed pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query q answers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First g with pre[g] ≥ q', 'next' => 'wrong_b'],
                ['label' => 'First g with pre[g] > q', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [0, 1, 1] instead of [1, 2, 2].\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(M log M + q log M). Examples → [1, 2, 2], [4, 2, 1, 1], [2, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
