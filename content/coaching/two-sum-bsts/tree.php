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
            'message' => "Problem: Given two binary search trees and a target, return whether one node from each tree sums to the target. For instance, trees with values {1, 2, 4} and {0, 1, 3} and target 5 give true; target 18 gives false. (Restated from memory; limits and examples may differ slightly.)\nPairs from the same tree count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one node from each tree', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The pair spans both trees.\nStep back to when you used one tree.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lookup for v in tree 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v in the set of tree 1', 'next' => 'wrong_b'],
                ['label' => 'target − v in the set of tree 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need the complement.\nStep back to when you looked up v.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Use less memory?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two in-order iterators, opposite directions', 'next' => 'success'],
                ['label' => 'Copy both trees to arrays', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Arrays still take O(n) space.\nStep back to when you copied the trees.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n1 + n2). {1, 2, 4}, {0, 1, 3}, 5 → true. Target 18 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
