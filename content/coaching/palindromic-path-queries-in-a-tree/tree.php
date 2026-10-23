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
            'message' => "Read the problem statement above.\nPath mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm[u] ⊕ m[v] ⊕ bit(lca)', 'next' => 's2'],
                ['label' => 'm[u] ⊕ m[v]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [false, false] instead of [true, false].\nStep back to when you dropped the lca.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Palindrome test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount = 0', 'next' => 'wrong_b'],
                ['label' => 'popcount ≤ 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [false, false] instead of [true, false].\nStep back to when you forbade a middle letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [true, false], [false, false, true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
