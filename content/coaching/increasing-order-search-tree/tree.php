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
            'message' => "Read the problem statement above.\nWhich traversal gives sorted order in a BST?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In-order', 'next' => 's2'],
                ['label' => 'Pre-order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pre-order puts the root before smaller values.\nStep back to when you chose pre-order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At each visited node, what changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only tail.right = node', 'next' => 'wrong_b'],
                ['label' => 'node.left = null; tail.right = node; tail = node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leftover left links break the chain.\nStep back to when you kept left links.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the new root come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dummy.right', 'next' => 'success'],
                ['label' => 'The old root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The old root is not the smallest node.\nStep back to when you returned the old root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(h) space. [5,3,6,2,4,null,8,1,null,null,null,7,9] → [1,null,2,null,3,null,4,null,5,null,6,null,7,null,8,null,9]. [5,1,7] → [1,null,5,null,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
