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
            'message' => "Read the problem statement above.\nSum each node's greater values separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one reverse inorder pass', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) on a skewed tree.\nStep back to when you summed separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Traversal order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left, node, right', 'next' => 'wrong_b'],
                ['label' => 'Right, node, left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That visits smaller values first.\nStep back to when you went left first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total += val, then val = total', 'next' => 'success'],
                ['label' => 'val = total, then total += val', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The node's own value must be included.\nStep back to when you assigned first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [4,1,6,0,2,5,7,null,null,null,3,null,null,null,8] → [30,36,21,36,35,26,15,null,null,null,33,null,null,null,8]. [0,null,1] → [1,null,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
