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
            'message' => "Problem: Given a binary tree, return the largest average of node values over all subtrees (a node with all its descendants). For instance, a root 5 with children 6 and 1 gives 6. (Restated from memory; limits and examples may differ slightly.)\nWhat does each call return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The subtree\'s sum and node count', 'next' => 's2'],
                ['label' => 'Only its average', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Averages cannot be combined without sizes.\nStep back to when you returned the average.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Traversal order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pre-order', 'next' => 'wrong_b'],
                ['label' => 'Post-order: children first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A node needs its children's totals.\nStep back to when you went parent first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compare averages?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floating division, or cross-multiply', 'next' => 'success'],
                ['label' => 'Integer division', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It truncates the averages.\nStep back to when you used integer division.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Root 5 with children 6 and 1 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
