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
            'message' => "Problem: Given a binary tree and two nodes p and q, return their lowest common ancestor, or null if either node is not in the tree. For instance, in [3,5,1,6,2,0,8], LCA(5, 1) = 3, while LCA(5, 10) is null when 10 is absent. (Restated from memory; limits and examples may differ slightly.)\nStop at p before its subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: recurse first, then check', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. q might be below p and must be confirmed.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Result is non-null', 'next' => 'wrong_b'],
                ['label' => 'found == 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single found node also returns non-null.\nStep back to when you trusted the result.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both non-null → this node; else the non-null side', 'next' => 'success'],
                ['label' => 'Always the left side', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer may be on the right.\nStep back to when you took left.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check: (5, 1) → 3; (5, absent) → null.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
