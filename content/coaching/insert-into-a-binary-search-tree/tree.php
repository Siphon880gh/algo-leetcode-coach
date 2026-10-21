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
            'message' => "Read the problem statement above.\nWhere can the new value go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As a leaf, at the null child reached by BST order', 'next' => 's2'],
                ['label' => 'As the new root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That would need restructuring; any valid BST is accepted, so a leaf is simplest.\nStep back to when you made it the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Do you need to rebalance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, to keep it balanced', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem does not require balance.\nStep back to when you rebalanced.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original root, or the new node if the tree was empty', 'next' => 'success'],
                ['label' => 'The new node always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The caller needs the whole tree.\nStep back to when you returned the new node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h) time. [4,2,7,1,3], val = 5 → [4,2,7,1,3,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
