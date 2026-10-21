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
            'message' => "Read the problem statement above.\nInsert each value from the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass with bounds', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeated insertion is O(n²) on a sorted input.\nStep back to when you inserted one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does build(bound) return null?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when the input is used up', 'next' => 'wrong_b'],
                ['label' => 'When the input is used up or the next value is above bound', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A value above the bound belongs to an ancestor's right side.\nStep back to when you ignored the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Bounds for the children of node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left gets node.val, right keeps bound', 'next' => 'success'],
                ['label' => 'Both get node.val', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Right-side values exceed node.val.\nStep back to when you gave both node.val.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [8,5,1,7,10,12] → [8,5,10,1,7,null,12]. [1,3] → [1,null,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
