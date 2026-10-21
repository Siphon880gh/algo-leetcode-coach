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
            'message' => "Problem: Given an N-ary tree, return its diameter: the longest path between two nodes, as the statement measures it (typically in edges). For instance, a root with children A and B, where A has child C, has diameter 3. (Restated from memory; limits and examples may differ slightly.)\nThrough the root only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any node', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The longest path may sit in a subtree.\nStep back to when you fixed the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Children to combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All children summed', 'next' => 'wrong_b'],
                ['label' => 'Two deepest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path uses at most two branches.\nStep back to when you summed all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track top two', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two variables suffice.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example tree → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
