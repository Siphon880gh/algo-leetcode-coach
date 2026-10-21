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
            'message' => "Read the problem statement above.\nRebuild the array and the tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the right spine changes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The new value comes last, so it only affects the right side.\nStep back to when you rebuilt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "val > root.val. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert into the left subtree', 'next' => 'wrong_b'],
                ['label' => 'New node with the old root as its left child', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old array is entirely to its left.\nStep back to when you went left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "val < root.val. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'root.right = insert(root.right, val)', 'next' => 'success'],
                ['label' => 'Make it the left child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It comes after root in the array, so it is to the right.\nStep back to when you went left.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h). [4,1,3,null,null,2], 5 → [5,4,null,1,3,null,null,2]. [5,2,4,null,1], 3 → [5,2,4,null,1,null,3]. [5,2,3,null,1], 4 → [5,2,4,null,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
