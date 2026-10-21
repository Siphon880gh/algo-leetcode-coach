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
            'message' => "Problem: Given a binary tree and an array of its nodes (all present and distinct), return the lowest common ancestor of all of them. For instance, in [3,5,1,6,2,0,8,null,null,7,4], LCA of {4, 7} is 2 and of {7, 6, 2, 4} is 5. (Restated from memory; limits and examples may differ slightly.)\nPairwise LCA reduction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one traversal with a set', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That repeats O(n) work per node.\nStep back to when you reduced pairwise.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a target node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep searching below', 'next' => 'wrong_b'],
                ['label' => 'Return it immediately', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Targets below it have it as an ancestor, and all targets exist.\nStep back to when you searched below.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both sides non-null?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'This node is the answer so far', 'next' => 'success'],
                ['label' => 'Pick the left', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Targets split here.\nStep back to when you picked a side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check: {4, 7} → 2; {7, 6, 2, 4} → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
