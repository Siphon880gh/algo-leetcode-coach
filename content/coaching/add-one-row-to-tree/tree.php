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
            'message' => "Read the problem statement above.\ndepth is 1. What do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Make a new root with the old tree as its left child', 'next' => 's2'],
                ['label' => 'Treat it like any other depth', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. There is no node at depth 0 to rewire, so this case needs its own rule.\nStep back to when you skipped the special case.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nodes do you change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node at depth', 'next' => 'wrong_b'],
                ['label' => 'Every node at depth − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new row goes between depth − 1 and depth, so you need the parents of the new row.\nStep back to when you went one level too deep.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you rewire a node p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p.left = Node(val, left = old left); p.right = Node(val, right = old right)', 'next' => 'success'],
                ['label' => 'Put both old children under the new left node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Left subtrees stay on the left and right subtrees stay on the right.\nStep back to when you moved both under one node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Special-case depth 1, then rewire every node at depth − 1: O(n) time. [4,2,6,3,1,5], val 1, depth 2 → [4,1,1,2,null,null,6,3,1,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
