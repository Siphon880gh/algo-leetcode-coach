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
            'message' => "Read the problem statement above.\nIn what order are values recorded?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each child from left to right, then the node', 'next' => 's2'],
                ['label' => 'The node, then the children', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is preorder (589).\nStep back to when you put the node first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An iterative trick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Do the preorder (children pushed in reverse), then reverse', 'next' => 'wrong_b'],
                ['label' => 'Pop a node, record it, push its children in normal order, and reverse the list at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reversing that preorder puts the rightmost child's subtree first.\nStep back to when you reused preorder.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can you skip the final reverse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: push a node back with a visited flag before its children, and record it on the second pop', 'next' => 'success'],
                ['label' => 'Yes: record each node when it is first popped', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recording a node on its first pop is preorder.\nStep back to when you recorded on the first pop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Children, then the node; iteratively, reverse or a visited flag: O(n) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
