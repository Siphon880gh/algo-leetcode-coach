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
            'message' => "Read the problem statement above.\nWhich value must every node match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The root\'s value', 'next' => 's2'],
                ['label' => 'Only the leaves\' values need to match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every node, not just the leaves, must equal the same value.\nStep back to when you checked only leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A node differs. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep collecting values', 'next' => 'wrong_b'],
                ['label' => 'Return false right away', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One mismatch decides the answer.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need a set of all values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one comparison per node', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It works but uses O(n) extra space.\nStep back to when you built a set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,1,1,1,null,1] → true. [2,2,2,5,2] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
