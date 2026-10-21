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
            'message' => "Read the problem statement above.\nCompute subtree depths with a separate call at every node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: return depth and candidate from one DFS', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) on a skewed tree.\nStep back to when you recomputed depths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left and right are equally deep. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left candidate', 'next' => 'wrong_b'],
                ['label' => '(depth + 1, this node)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The deepest nodes lie on both sides, so this node is their lowest common ancestor.\nStep back to when you picked a side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The left side is deeper. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(left depth + 1, the left candidate)', 'next' => 'success'],
                ['label' => '(left depth + 1, this node)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All the deepest nodes are on the left, so a smaller subtree there contains them.\nStep back to when you returned this node.",
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
