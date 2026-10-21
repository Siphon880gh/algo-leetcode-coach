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
            'message' => "Read the problem statement above.\nnode.val < low. Search where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the right subtree', 'next' => 's2'],
                ['label' => 'Both subtrees', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Everything on its left is even smaller.\nStep back to when you searched both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "node.val > high. Search where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the right subtree', 'next' => 'wrong_b'],
                ['label' => 'Only the left subtree', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Larger values are on the right, so they are out of range too.\nStep back to when you went right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Are low and high included?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, both', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The range is inclusive.\nStep back to when you excluded them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) worst case, O(h) space. [10,5,15,3,7,null,18], 7, 15 → 32. [10,5,15,3,7,13,18,1,null,6], 6, 10 → 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
