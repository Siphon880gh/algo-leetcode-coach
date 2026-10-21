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
            'message' => "Read the problem statement above.\nThe root values match. Done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare the whole trees with sameTree', 'next' => 's2'],
                ['label' => 'Yes: the same root value means a subtree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values below can differ, and a subtree must match all the way down to the leaves.\nStep back to when you trusted the root value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "sameTree fails at this node. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'wrong_b'],
                ['label' => 'Try root.left and root.right as the start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The match can start deeper in the tree.\nStep back to when you gave up at the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster than O(m · n)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Serialize both with null markers and separators, then run KMP', 'next' => 'success'],
                ['label' => 'Serialize without null markers', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without null markers different shapes give the same string: [1,2] and [1,null,2] both read 1,2.\nStep back to when you dropped the nulls.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. sameTree at each node, or serialization plus KMP: O(m · n), or O(m + n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
