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
            'message' => "Problem: Problem: Given a binary tree, return true if removing exactly one edge can split it into two trees whose node values have equal sums. (Restated from memory; limits and examples may differ slightly.)\nWhat does removing an edge do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cuts off one subtree, so you need a subtree summing to total / 2', 'next' => 's2'],
                ['label' => 'Splits the tree into its left and right halves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any edge can be cut, not just the root's.\nStep back to when you only split at the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which subtree sums do you record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them, root included', 'next' => 'wrong_b'],
                ['label' => 'Every one except the root\'s own sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cutting needs an edge above the subtree; with total 0, the root's sum 0 would falsely match.\nStep back to when you kept the root's sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total is odd. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'success'],
                ['label' => 'Look for floor(total / 2)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two equal integer halves need an even total.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Postorder subtree sums, then check total / 2: O(n). [5,10,10,null,null,2,3] → true. [1,2,10,null,null,2,20] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
