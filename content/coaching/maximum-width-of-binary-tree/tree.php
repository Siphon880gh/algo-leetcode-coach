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
            'message' => "Read the problem statement above.\nDo nulls between nodes count toward width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: width spans the leftmost to rightmost node, gaps included', 'next' => 's2'],
                ['label' => 'No: count the nodes on the level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The width includes the null positions between the end nodes.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you know a node's position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert null placeholders into the BFS queue', 'next' => 'wrong_b'],
                ['label' => 'Heap indexing: children of i are 2i and 2i + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Placeholders can grow exponentially on a sparse, deep tree.\nStep back to when you queued nulls.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Indexes double each level. How do you avoid overflow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract the level\'s first index before computing the children', 'next' => 'success'],
                ['label' => 'Use floating point', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floats lose precision; re-basing keeps every index below the width.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS with re-based indexes: O(n). [1,3,2,5,3,null,9] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
