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
            'message' => "Read the problem statement above.\nnode.val < low. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return trim(node.right)', 'next' => 's2'],
                ['label' => 'Return null', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The right subtree may still hold values in range.\nStep back to when you returned null.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why can you discard node.left as well?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You cannot; trim it too', 'next' => 'wrong_b'],
                ['label' => 'In a BST every left value is smaller than node.val, so it is also below low', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The BST order makes the whole left side invalid.\nStep back to when you kept the left side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "node.val is in range. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'node.left = trim(node.left), node.right = trim(node.right), return node', 'next' => 'success'],
                ['label' => 'Return node unchanged', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Its subtrees may still contain out-of-range nodes.\nStep back to when you stopped trimming.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Recursive trim: O(n) time, O(h) space. [1,0,2], low = 1, high = 2 → [1,null,2]. [3,0,4,null,2,null,null,1], low = 1, high = 3 → [3,2,null,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
