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
            'message' => "Problem: Given a binary tree and an array, decide whether the array matches the values along some root-to-leaf path. For instance, in the tree [0,1,0,0,1,0,null,null,1,0,0], [0,1,0,1] is valid; a match ending at a non-leaf is not. (Restated from memory; limits and examples may differ slightly.)\nMatch ends at an inner node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not valid', 'next' => 's2'],
                ['label' => 'Valid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The path must reach a leaf.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mismatch at a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the node', 'next' => 'wrong_b'],
                ['label' => 'Prune this branch', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths cannot skip nodes.\nStep back to when you skipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Path longer than the array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop at i = len', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Extra nodes mean no match.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,1,0,1] in [0,1,0,0,1,0,null,null,1,0,0] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
