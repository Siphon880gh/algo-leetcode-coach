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
            'message' => "Read the problem statement above.\nCheck against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left max and right min', 'next' => 's2'],
                ['label' => 'Only the direct children', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Deeper nodes can break the BST order.\nStep back to when you checked children only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(false, 0, 0, 0)', 'next' => 'wrong_b'],
                ['label' => '(true, +∞, −∞, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An empty tree is a valid BST.\nStep back to when you marked it invalid.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All values negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 'success'],
                ['label' => 'The largest negative', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The empty BST has sum 0.\nStep back to when you returned a negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 20. [4,3,null,1,2] → 2. [-4,-2,-5] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
