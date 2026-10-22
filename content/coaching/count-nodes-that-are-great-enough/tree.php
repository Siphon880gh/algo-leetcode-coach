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
            'message' => "Problem: Given a binary tree and an integer k, count the nodes whose subtree has enough nodes and whose value is larger than at least k of the values in their subtree. The exact condition, including how the node itself and ties are counted, and the limits are in the official statement. For instance, with root 7 and children 3 and 5, and k = 2, only the root counts, so the answer is 1. (Restated from memory; limits and examples may differ slightly.)\nEach subtree passes up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its k smallest values', 'next' => 's2'],
                ['label' => 'All of its values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. On a path tree that copies O(n²) values.\nStep back to when you kept everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The list a node passes up includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only its children’s values', 'next' => 'wrong_b'],
                ['label' => 'Its own value too', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leaves would pass nothing; the example → 0 instead of 1.\nStep back to when you left the node out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k log k). The example → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
