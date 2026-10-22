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
            'message' => "Read the problem statement above.\nTree-2 radius?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k − 1', 'next' => 's2'],
                ['label' => 'k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The new edge uses one step: example 1 → [12, 10, 12, 11, 11].\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which tree-2 node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node 0', 'next' => 'wrong_b'],
                ['label' => 'The best one, same for every i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. edges1 [[0, 1]], edges2 [[0, 1], [1, 2]], k = 2 → [4, 4] instead of [5, 5].\nStep back to when you picked node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² + m²). Examples → [9, 7, 9, 8, 8], [6, 3, 3, 3, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
