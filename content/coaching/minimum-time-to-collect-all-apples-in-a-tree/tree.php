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
            'message' => "Read the problem statement above.\nEdge directions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undirected: track parent', 'next' => 's2'],
                ['label' => 'Parent → child as given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Edges are not oriented.\nStep back to when you trusted the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Child subtree has no apple?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 2', 'next' => 'wrong_b'],
                ['label' => 'Add 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You never need to walk there.\nStep back to when you added 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Edge cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 (there and back)', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You must return to vertex 0.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Apples at 2, 4, 5 → 8. At 2, 5 → 6. None → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
