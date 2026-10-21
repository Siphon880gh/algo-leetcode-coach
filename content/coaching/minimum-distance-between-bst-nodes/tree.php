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
            'message' => "Read the problem statement above.\nCompare each node with its children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the closest value may be far away in the tree', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The inorder predecessor or successor can be deep in another branch.\nStep back to when you compared with children.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why is inorder enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It visits leaves first', 'next' => 'wrong_b'],
                ['label' => 'It yields sorted values, and the closest pair in a sorted list is adjacent', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorted order is the point.\nStep back to when you relied on leaf order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What state do you carry?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous value and the best difference', 'next' => 'success'],
                ['label' => 'A list of all values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That works but needs O(n) space; one previous value suffices.\nStep back to when you stored everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(h) space. [4,2,6,1,3] → 1. [1,0,48,null,null,12,49] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
