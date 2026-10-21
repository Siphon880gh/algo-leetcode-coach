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
            'message' => "Read the problem statement above.\nPrune top-down?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: postorder, since a node\'s fate depends on its pruned children', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Whether a node can go depends on its subtrees, so they must be pruned first.\nStep back to when you went top-down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you remove a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its value is 0', 'next' => 'wrong_b'],
                ['label' => 'Its value is 0 and both pruned children are null', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 0 node with a 1 below it must stay.\nStep back to when you removed every 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can the root be removed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: return null if the whole tree has no 1', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tree of only zeros prunes to nothing.\nStep back to when you kept the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,null,0,0,1] → [1,null,0,null,1]. [0] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
