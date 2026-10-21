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
            'message' => "Read the problem statement above.\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Post-order', 'next' => 's2'],
                ['label' => 'Pre-order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A parent may become a leaf only after its children go.\nStep back to when you checked the parent first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Delete an inner node with the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: only leaves', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inner nodes stay.\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How to delete?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return null to the parent', 'next' => 'success'],
                ['label' => 'Set its value to 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The node must leave the tree.\nStep back to when you zeroed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,2,null,2,4], 2 → [1,null,3,null,4]. [1,2,null,2,null,2], 2 → [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
