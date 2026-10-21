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
            'message' => "Problem: A tree is given by a node count, a parent array (the root has parent −1), and node values. Delete every subtree whose values sum to 0 and return how many nodes remain. For instance, parents [−1,0,0] with values [1,−1,0] give 0, and with values [2,−1,1] give 3. (Restated from memory; limits and examples may differ slightly.)\nDelete what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtrees with sum 0', 'next' => 's2'],
                ['label' => 'Nodes with value 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule is about subtree sums.\nStep back to when you deleted zero-valued nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Traversal order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pre-order', 'next' => 'wrong_b'],
                ['label' => 'Post-order: children first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A sum needs its children first.\nStep back to when you visited the parent first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A zero-sum child contributes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum 0, count 0', 'next' => 'success'],
                ['label' => 'Its full count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That subtree is deleted.\nStep back to when you kept its count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Values [1,−1,0] → 0. Values [2,−1,1] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
