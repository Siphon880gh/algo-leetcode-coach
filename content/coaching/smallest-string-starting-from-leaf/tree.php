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
            'message' => "Read the problem statement above.\nAt each node, follow the child with the smaller letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare full strings at the leaves', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The strings are read from the leaf up, so a smaller child letter can still give a larger string.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which direction is the string read?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the root down', 'next' => 'wrong_b'],
                ['label' => 'From the leaf up to the root', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem asks for strings starting at a leaf.\nStep back to when you read top-down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is a node with one child a leaf?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only nodes with no children', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The string must start at a real leaf.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · h). [0,1,2,3,4,3,4] → \"dba\". [25,1,3,1,3,0,2] → \"adz\". [2,2,1,null,1,0,null,0] → \"abc\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
