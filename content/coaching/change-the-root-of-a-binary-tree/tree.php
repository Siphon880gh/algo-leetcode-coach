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
            'message' => "Problem: Each node has a parent pointer. Given the root and a leaf, re-root the tree at the leaf by walking from the leaf up to (not including) the root: each node on that path moves an existing left child to its right side and adopts its old parent as its left child, with the parent dropping its link to it and all parent pointers updated, as the statement specifies. For instance, with root 1 (left 2, right 3) and leaf 2, the new root is 2, whose left child is 1, which keeps its right child 3. (Restated from memory; limits and examples may differ slightly.)\nFirst action at each step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clear the parent\'s link to cur', 'next' => 's2'],
                ['label' => 'Set cur.left = parent', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without clearing, the parent still points down and forms a cycle.\nStep back to when you attached first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "cur has a left child?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop it', 'next' => 'wrong_b'],
                ['label' => 'Move it to cur.right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No node may be lost.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Parent pointers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update every one on the path; new root\'s is null', 'next' => 'success'],
                ['label' => 'Leave them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They must match the new shape.\nStep back to when you left them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h). Constructed check → 2 with left 1, and 1 keeps right 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
