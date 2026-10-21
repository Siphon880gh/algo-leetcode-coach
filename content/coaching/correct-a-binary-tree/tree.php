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
            'message' => "Problem: A binary tree has exactly one defective node whose right child pointer wrongly points to another node on the same level to its right. Remove the defective node and everything below it (not the node it points to) and return the root. For instance, if in [1,2,3] node 2's right pointer points to 3, the result is [1,null,3]. (Restated from memory; limits and examples may differ slightly.)\nLevel order direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The wrongly pointed-to node must be seen first.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Defect test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x.right is null', 'next' => 'wrong_b'],
                ['label' => 'x.right already in seen', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The defect is a pointer to an existing node.\nStep back to when you checked null.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parent drops its link to the defective node', 'next' => 'success'],
                ['label' => 'Set x.right = null', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The whole defective subtree must go.\nStep back to when you cut only the bad pointer.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → [1,null,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
