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
            'message' => "Read the problem statement above.\nWhat is pre[1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The root of the left subtree (if there are children)', 'next' => 's2'],
                ['label' => 'The root of the right subtree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Preorder visits the left subtree right after the root.\nStep back to when you took the right one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get the left subtree size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Half of the remaining nodes', 'next' => 'wrong_b'],
                ['label' => 'Its root\'s postorder index − start + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Postorder ends the left subtree at its root, which fixes the size.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A node has one child. Left or right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either is valid; the traversals cannot tell', 'next' => 'success'],
                ['label' => 'It must be right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Preorder and postorder look the same for both, so any answer is accepted.\nStep back to when you forced a side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with an index map. pre = [1,2,4,5,3,6,7], post = [4,5,2,6,7,3,1] → [1,2,3,4,5,6,7]. pre = [1], post = [1] → [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
