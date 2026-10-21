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
                ['label' => 'Inorder gives sorted values; check neighbors only', 'next' => 's2'],
                ['label' => 'Compare every pair of values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All pairs is O(n²) = 1e8 and ignores the BST order.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbors matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each node and its children', 'next' => 'wrong_b'],
                ['label' => 'Consecutive values in inorder order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3 and 4 differ by 1 in [4,2,6,1,3], but 3 is a grandchild of 4.\nStep back to when you compared parent and child only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "ans = min(ans, v − prev); prev = v. O(n) time, O(h) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inorder neighbors, prev starts as none', 'next' => 'success'],
                ['label' => 'Start prev at 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Starting prev at 0 invents a value that is not in the tree.\nStep back to when you set prev = 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sorted neighbors via inorder. [4,2,6,1,3] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
