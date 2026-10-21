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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Visit nodes from largest to smallest with a running sum', 'next' => 's2'],
                ['label' => 'For each node, search the tree for larger values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Summing larger values separately for each node is O(n²).\nStep back to when you searched for larger values per node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which traversal visits values in descending order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left, node, right (inorder)', 'next' => 'wrong_b'],
                ['label' => 'Right, node, left (reverse inorder)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Normal inorder goes ascending; it would add smaller values.\nStep back to when you went left first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "s += node.val; node.val = s. O(n) time, O(h) space (Morris gives O(1)).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse inorder: add, then write s', 'next' => 'success'],
                ['label' => 'Set node.val = s first, then add node.val to s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The update must use the original value before overwriting; s += then assign is the right order.\nStep back to when you assigned first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Descending walk with a running sum. Same as 1038.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
