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
            'message' => "Problem: Given a binary tree, return the values of nodes that are the only child of their parent (the root is never lonely), in any order. For instance, [1,2,3,null,4] → [4]. (Restated from memory; limits and examples may differ slightly.)\nWhere to decide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the parent', 'next' => 's2'],
                ['label' => 'At the child alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A child cannot see its sibling.\nStep back to when you decided at the child.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lonely', 'next' => 'wrong_b'],
                ['label' => 'Never lonely', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It has no parent.\nStep back to when you added the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leaves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if they are an only child', 'next' => 'success'],
                ['label' => 'Always lonely', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Loneliness is about siblings, not children.\nStep back to when you added every leaf.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,null,4] → [4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
