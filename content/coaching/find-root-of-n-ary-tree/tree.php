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
            'message' => "Problem: All nodes of an N-ary tree with unique values are given in arbitrary order; return the root. For instance, nodes 1→{2,3} and 3→{4}: only 1 is never a child. (Restated from memory; limits and examples may differ slightly.)\nFirst node in the list is the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: order is arbitrary', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The list is shuffled.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does cancellation work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values are sorted', 'next' => 'wrong_b'],
                ['label' => 'Non-roots appear once as a node and once as a child', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order is irrelevant.\nStep back to when you relied on order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "O(n) space alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set of all children', 'next' => 'success'],
                ['label' => 'Rebuild the tree', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A set of child references is enough.\nStep back to when you rebuilt.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
