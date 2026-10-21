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
            'message' => "Read the problem statement above.\nValue of an operator node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Combine its children’s values', 'next' => 's2'],
                ['label' => 'Its own value, non-zero means true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3,1,0] is true AND false → true instead of false.\nStep back to when you read the node’s own value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Node value 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AND', 'next' => 'wrong_b'],
                ['label' => 'OR', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2,1,0] → false instead of true.\nStep back to when you read 2 as AND.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Node value 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AND', 'next' => 'success'],
                ['label' => 'XOR', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [3,1,1] → false instead of true.\nStep back to when you read 3 as XOR.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
