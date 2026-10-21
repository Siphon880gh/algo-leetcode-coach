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
            'message' => "Read the problem statement above.\nExpand both trees to grids, OR them, rebuild?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: recurse on the two trees directly', 'next' => 's2'],
                ['label' => 'Yes: build both n × n grids first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Expanding throws away the compression; one leaf can stand for the whole grid.\nStep back to when you expanded the grids.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One side is a leaf. What is the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse into the four children of the leaf', 'next' => 'wrong_b'],
                ['label' => 'A leaf of 1s wins outright; a leaf of 0s returns the other tree', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A leaf has no children. 1 OR anything is 1, and 0 OR x is x.\nStep back to when you recursed into a leaf.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both are internal, so you OR the four children pairwise. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If all four results are leaves with the same value, merge them into one leaf', 'next' => 'success'],
                ['label' => 'Return the four children as they are', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Four equal leaves must collapse into one, or the result is not a valid quad-tree.\nStep back to when you kept four equal leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Leaf shortcuts, pairwise recursion, and merging equal leaves: O(nodes) time, O(depth) stack.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
