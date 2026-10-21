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
            'message' => "Read the problem statement above.\nFind the deepest leaves, then run a general LCA?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one post-order pass does both', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That needs extra passes.\nStep back to when you split it into two steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left and right heights are equal. Answer for this subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left child\'s answer', 'next' => 'wrong_b'],
                ['label' => 'This node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deepest leaves exist on both sides.\nStep back to when you chose the left side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Left is deeper. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left child\'s answer', 'next' => 'success'],
                ['label' => 'This node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All deepest leaves are on the left.\nStep back to when you chose this node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,5,1,6,2,0,8,null,null,7,4] → [2,7,4]. [1] → [1]. [0,1,3,null,2] → [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
