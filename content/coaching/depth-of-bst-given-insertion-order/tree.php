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
            'message' => "Problem: Given a permutation of 1 … n as the order in which values are inserted into an initially empty binary search tree, return the depth of the tree: the number of nodes on its longest root-to-leaf path. For instance, [2,1,4,3] → 3, [2,1,3,4] → 3, and [1,2,3,4] → 4. (Restated from memory; limits and examples may differ slightly.)\nBuild the tree directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, O(n²) on sorted input', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A chain makes each insert O(n).\nStep back to when you built it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parent of the new value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the predecessor', 'next' => 'wrong_b'],
                ['label' => 'The deeper of predecessor and successor', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The later-inserted neighbour is lower and becomes the parent.\nStep back to when you chose the predecessor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max depth over all values', 'next' => 'success'],
                ['label' => 'Depth of the last value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The deepest node can be any value.\nStep back to when you took the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check → 3, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
